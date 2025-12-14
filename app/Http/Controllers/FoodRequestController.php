<?php

namespace App\Http\Controllers;

use App\Models\FoodRequest;
use App\Models\FoodDonation;
use Illuminate\Http\Request;

class FoodRequestController extends Controller
{
    public function index()
    {
        $requests = FoodRequest::with('foodDonation')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('food_requests.index', compact('requests'));
    }

    public function create()
    {
        $donations = FoodDonation::where('status', 'available')
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
                ->withErrors([
                    'quantity' => 'Jumlah request melebihi stok yang tersedia'
                ])
                ->withInput();
        }

        FoodRequest::create([
            'user_id'          => auth()->id(),
            'food_donation_id' => $donation->id,
            'quantity'         => $request->quantity,
            'status'           => 'pending',
        ]);

        return redirect()->route('requests.index')
            ->with('success', 'Request berhasil dibuat');
    }

    public function edit(FoodRequest $foodRequest)
    {
        if ($foodRequest->user_id !== auth()->id()) {
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
            'request' => $foodRequest,
            'donations' => $donations
        ]);
    }

    public function update(Request $request, FoodRequest $foodRequest)
    {
        if ($foodRequest->user_id !== auth()->id()) {
            abort(403);
        }

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
                ->withErrors([
                    'quantity' => 'Jumlah request melebihi stok yang tersedia'
                ])
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
        if ($foodRequest->user_id !== auth()->id()) {
            abort(403);
        }

        if ($foodRequest->status !== 'pending') {
            return back()->with('error', 'Request tidak bisa dibatalkan');
        }

        $foodRequest->delete();

        return redirect()->route('requests.index')
            ->with('success', 'Request berhasil dibatalkan');
    }
}
