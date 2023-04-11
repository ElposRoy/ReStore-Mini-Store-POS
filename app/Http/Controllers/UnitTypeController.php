<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\UnitType;
use Illuminate\Http\Request;

class UnitTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->toArray());
        $validated = $request->validate([
            'unit_type' => 'required|string|max:255',
        ]);
     
        $request->user()->unit_types()->create([
            'unit_type' => $validated['unit_type'],
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(UnitType $unit_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnitType $unit_type)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UnitType $unit_type)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnitType $unit_type)
    {
        //
    }
}
