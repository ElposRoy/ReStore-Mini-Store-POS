<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\UnitType;
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
            'products' => Product::with(['category','unit_type','purchases'])->paginate(),
            'categories'=> Category::all(),
            'unit_types'=> UnitType::all(),
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
    //  dd($request->toArray());

    try {
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
        
    } catch (\Throwable $th) {
        throw $th;
    }
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
        
  try{
    if ($request->hasFile('image')) {
        $validateImage=$request->validate(['image'=>'image']);
        $image = $validateImage['image']; // get the uploaded file
        $image->storeAs('images',$image->getClientOriginalName()); // store the image in the storage public/images directory
        $path = 'storage/images/'.$image->getClientOriginalName();
    } 
    
    else {
          //Problem is here, Even when the checkbox is clicked it will still upload the old image..... Now fixed 17/04/2023

        // if no image is uploaded, use the existing image path or set it to null
        $noImage=$request->validate([
            'image' => 'nullable|string', // add the nullable rule
        ]);
        $path = $noImage['image']; // use the existing image path or set it to null
    }

    $validated = $request->validate([
        'product_name' => 'required|string|max:255',
        //'image' => 'nullable|image',  //ensure the uploaded file is an image
        'stock_level' => 'required|numeric|max:999.99',
        'unit'=>'required|numeric|max:255',
        'unit_type_id' => 'required|integer|min:1|max:255',
        'category_id' => 'required|integer|min:1|max:255',
    ]);


    $product->update([
        'product_name' => $validated['product_name'],
        'image' => $path,
        'stock_level' => $validated['stock_level'],
        'unit'=> $validated['unit'],
        'unit_type_id' =>  $validated['unit_type_id'],
        'category_id' => $validated['category_id'],
    ]);


    }

    catch(\Throwable $th){
        throw $th;
    }

    
    
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            unlink($product->image);
        
            return redirect(route('products.index'));
        } catch (\Throwable $th) {
            throw $th;
        }
      

    //  
    
    }
}
