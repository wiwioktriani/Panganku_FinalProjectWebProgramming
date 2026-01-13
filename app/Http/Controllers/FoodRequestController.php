<?php

namespace App\Http\Controllers;

use App\Models\FoodRequest;
use App\Models\FoodDonation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodRequestController extends Controller
{

    public function index()
    {
        $foodRequests = FoodRequest::with(['foodDonation', 'user'])
            ->when(Auth::user()->role !== 'admin', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->latest()
            ->paginate(15);

        return view('food_requests.index', compact('foodRequests'));
    }

  
    public function create()
    {
     
        $donations = FoodDonation::where('user_id', '!=', Auth::id())
            ->where('quantity', '>', 0)
            ->get();

        return view('food_requests.create', compact('donations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'food_donation_id' => 'required|exists:food_donations,id',
            'quantity'         => 'required|integer|min:1',
        ]);

        $donation = FoodDonation::findOrFail($request->food_donation_id);

        if ($request->quantity > $donation->quantity) {
            return back()
                ->withErrors(['quantity' => 'Jumlah request melebihi stok yang tersedia'])
                ->withInput();
        }

        FoodRequest::create([
            'user_id'          => Auth::id(),
            'food_donation_id' => $donation->id,
            'quantity'         => $request->quantity,
            'status'           => 'pending',
        ]);

        return redirect()->route('requests.index')
            ->with('success', 'Request berhasil dibuat');
    }

    public function edit(FoodRequest $foodRequest)
    {
        if ($foodRequest->user_id !== Auth::id()){
            abort(403);
        }

        if ($foodRequest->status !== 'pending') {
            return redirect()->route('requests.index')
                ->with('error', 'Request tidak bisa diedit');
        }

        $donations = FoodDonation::where('status', 'available')
            ->where('quantity', '>', 0)
            ->get();

        return view('food_requests.edit', [
            'foodRequest' => $foodRequest,
            'donations'   => $donations
        ]);
    }

    public function update(Request $request, FoodRequest $foodRequest)
    {
        $this->authorizeRequest($foodRequest);

        if ($foodRequest->status !== 'pending') {
            return redirect()->route('requests.index')
                ->with('error', 'Request tidak bisa diupdate');
        }

        $request->validate([
            'food_donation_id' => 'required|exists:food_donations,id',
            'quantity'         => 'required|integer|min:1',
        ]);

        $donation = FoodDonation::findOrFail($request->food_donation_id);

        if ($request->quantity > $donation->quantity) {
            return back()
                ->withErrors(['quantity' => 'Jumlah request melebihi stok yang tersedia'])
                ->withInput();
        }

        $foodRequest->update([
            'food_donation_id' => $donation->id,
            'quantity'         => $request->quantity,
        ]);

        return redirect()->route('requests.index')
            ->with('success', 'Request berhasil diupdate');
    }

    public function destroy(FoodRequest $foodRequest)
    {
        
        if ($foodRequest->user_id !== Auth::id()){
            abort(403);
        }
        
        if ($foodRequest->status !== 'pending') {
            return back()->with('error', 'Request tidak bisa dibatalkan');
        }

        $foodRequest->delete();

        return redirect()->route('requests.index')
            ->with('success', 'Request berhasil dibatalkan');
    }

    public function approve(FoodRequest $foodRequest)
    {
        $foodRequest->load('foodDonation');

        if ($foodRequest->foodDonation->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $foodRequest->update(['status' => 'approved']);

        $donation = $foodRequest->foodDonation;
        $donation->decrement('quantity', $foodRequest->quantity);

        return back()->with('success', 'Permintaan telah disetujui.');
    }

    public function reject(FoodRequest $foodRequest)
    {
        $foodRequest->load('foodDonation');

        if ($foodRequest->foodDonation->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $foodRequest->update(['status' => 'rejected']);

        return back()->with('success', 'Permintaan telah ditolak.');
    }
}
