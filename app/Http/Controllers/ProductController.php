<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get last 5 products from DB
        $products = Product::latest()->paginate(5);

        // Pass the products to the view and show page in the url
        return view('products.list', compact('products'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate on the Product fields
        $request->validate([
            'name'=>'required',
            'price'=> 'required',
            'quantity'=> 'required',
        ]);

        // Create new product in the DB
        Product::create($request->all());

        // redirect to Home Page
        return redirect()->route('products.index')->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validate on the Product fields
        $request->validate([
            'name'=>'required',
            'price'=> 'required',
            'quantity'=> 'required',
        ]);

        // Update product in the DB
        $product->update($request->all());

        // redirect to Home Page
        return redirect()->route('products.index')->with('success','Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete product from DB
        $product->delete();

        // redirect to Home Page
        return redirect()->route('products.index')->with('success','Product deleted successfully.');
    }
}
