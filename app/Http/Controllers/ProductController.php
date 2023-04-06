<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Unit_type;
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
            'products' => Product::with(['category','unit_type'])->paginate(),
            'categories'=>Category::all(),
            'unit_types'=>Unit_type::all(),
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
    //   dd($request->toArray());
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'image' => 'required|image', // ensure the uploaded file is an image
            'stock_level' => 'required|numeric|max:999.99',
            'unit'=>'required|numeric|max:255',
            'unit_type_id' => 'required|integer|min:1|max:255',
            'category_id' => 'required|integer|min:1|max:255',
          
        ]);
        // dd($validated);
        $image = $validated['image']; // get the uploaded file
       
        $image->storeAs('images',$image->getClientOriginalName()); // store the image in the storage public/images directory
        
        $path = 'storage/images/'.$image->getClientOriginalName();
    
        //dd($path);

        $request->user()->products()->create([
            'product_name' => $validated['product_name'],
            'image' => $path, // save the file path in the database
            'stock_level' => $validated['stock_level'],
            'unit'=> $validated['unit'],
            'unit_type_id' =>  $validated['unit_type_id'],
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
       
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'image' => 'required|image', // ensure the uploaded file is an image
            'price' => 'required|numeric|max:999999.99',
            'quantity' => 'required|integer|max:255',
            'category_id' => 'required|integer|min:1|max:255',
        ]);
        $image = $validated['image']; // get the uploaded file
       
        $image->storeAs('images',$image->getClientOriginalName()); // store the image in the storage public/images directory
        
        $path = 'storage/images/'.$image->getClientOriginalName();


        $product->update([
            'product_name' => $validated['product_name'],
            'image' => $path, // save the file path in the database
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'category_id' => $validated['category_id'],
        ]);

      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect(route('products.index'));
        } catch (\Throwable $th) {
            throw $th;
        }
      

    //  
    
    }
}
