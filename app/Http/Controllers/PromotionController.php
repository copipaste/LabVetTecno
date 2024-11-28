<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;
use Inertia\Inertia;

class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();
        return Inertia::render('Promotion/Index', ['promotions' => $promotions]);
    }
    
    public function create()
    {
        return Inertia::render('Promotions/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'status' => 'required|boolean',
            'discountPercentage' => 'required|numeric|min:0|max:100',
        ]);

        Promotion::create($request->all());
        return redirect()->route('promotions.index');
    }

    public function edit(Promotion $promotion)
    {
        return Inertia::render('Promotions/Edit', ['promotion' => $promotion]);
    }

    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
            'status' => 'required|boolean',
            'discountPercentage' => 'required|numeric|min:0|max:100',
        ]);

        $promotion->update($request->all());
        return redirect()->route('promotions.index');
    }

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->route('promotions.index');
    }
}
