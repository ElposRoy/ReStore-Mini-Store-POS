<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Purchase;
use App\Models\Product;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Purchases/Index', [
            'purchases' => Purchase::with(['product'])->paginate(),
            'products'=>Product::all(),
        ]);
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
        try {
          
        $validated= $request -> validate([
            'product_id' => 'required|integer|min:1|max:255',
            'original_price' => 'required|numeric|between:0,9999999.99',
            'sale_price' => 'required|numeric|between:0,9999999.99',
            'quantity' => 'required|integer|max:255',
            'purchasedDate' => 'required|date_format:Y-m-d',
            'expirationDate' => 'required|date_format:Y-m-d',
        ]);
    
       Purchase::create([
            'product_id' => $validated['product_id'],
            'original_price' => $validated['original_price'],
            'sale_price' => $validated['sale_price'],
            'quantity' => $validated['quantity'],
            'purchased_at' => $validated['purchasedDate'],
            'expired_at' => $validated['expirationDate'],
        ]);

        } catch (\Throwable $th) {
            throw $th;
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(purchase $purchase)
    {
        //
    }
}
