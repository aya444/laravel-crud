<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CategoryService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService, private CategoryService $categoryService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->getProducts();

        // Pass the products to the view and show page in the url
        return view('products.list', compact('products'))->with(request()->input('page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate on the Product fields
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
        ]);

        // Remove the image field from the request for seperation of concerns and handeling saving of file
        // Added current logged user_id
        $data = array_merge($request->except('image'), ['user_id' => auth()->id()]);

        $this->productService->createProduct(
            $data,
            $request->file('image')
        );

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
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
        $categories = $this->categoryService->getAllCategories();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ];

        // Add image validation only if a new image is being uploaded
        if ($request->hasFile('image')) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        // Validate on the Product fields
        $request->validate($rules);

        $this->productService->updateProduct(
            $product,
            $request->except('image'),
            $request->file('image')
        );

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
