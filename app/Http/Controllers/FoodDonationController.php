<?php

namespace App\Http\Controllers;

use App\Models\FoodDonation;
use App\Models\FoodCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodDonationController extends Controller
{
    public function index()
    {
        $donations = FoodDonation::with(['user', 'category'])
            ->latest()
            ->get();

        return view('food_donations.index', compact('donations'));
    }

    public function create()
    {
        $categories = FoodCategory::all();
        return view('food_donations.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'food_name' => 'required|string|max:255',
            'food_category_id' => 'required|exists:food_categories,id',
            'quantity' => 'required|integer|min:1',
            'expired_at' => 'required|date',
            'description' => 'nullable|string',
        ]);

        FoodDonation::create([
            'user_id' => Auth::id(),
            'food_name' => $request->food_name,
            'food_category_id' => $request->food_category_id,
            'quantity' => $request->quantity,
            'expired_at' => $request->expired_at,
            'description' => $request->description,
            'status' => 'active',
        ]);

        return redirect()->route('donations.index')
            ->with('success', 'Donasi berhasil ditambahkan');
    }

    public function edit(FoodDonation $donation)
    {
        if ($donation->user_id !== Auth::id()) {
            abort(403);
        }

        $categories = FoodCategory::all();
        return view('food_donations.edit', compact('donation', 'categories'));
    }

    public function update(Request $request, FoodDonation $donation)
    {
        if ($donation->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'food_category_id' => 'required|exists:food_categories,id',
            'food_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'expired_at' => 'required|date',
            'status' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $donation->update([
            'food_category_id' => $request->food_category_id,
            'food_name' => $request->food_name,
            'quantity' => $request->quantity,
            'expired_at' => $request->expired_at,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->route('donations.index')
            ->with('success', 'Donasi berhasil diperbarui');
    }

    public function destroy(FoodDonation $donation)
    {
        if ($donation->user_id !== Auth::id()) {
            abort(403);
        }

        $donation->delete();

        return redirect()->route('donations.index')
            ->with('success', 'Donasi berhasil dihapus');
    }
}