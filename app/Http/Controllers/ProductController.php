<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Products/Index', [
            'products' => Product::with(['category'])->paginate(),
            'categories'=>Category::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categories = Category::all();
        // $category_names = $categories->pluck('title', 'id');
        // return Inertia::render('Products/Index', [
        //     'category_names' => $category_names,
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'file' => 'required|image', // ensure the uploaded file is an image
            'price' => 'required|numeric|max:999999.99',
            'quantity' => 'required|integer|max:255',
            'category_id' => 'required|integer|min:1|max:255',
          
        ]);
        // dd($validated);
        $image = $validated['file']; // get the uploaded file
       
        $image->storeAs('images',$image->getClientOriginalName()); // store the image in the storage public/images directory
        
        $path = 'storage/images/'.$image->getClientOriginalName();
    
        //dd($path);

        $request->user()->products()->create([
            'product_name' => $validated['product_name'],
            'image' => $path, // save the file path in the database
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'category_id' => $validated['category_id'],
        ]);

       


    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
