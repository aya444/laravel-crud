<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\FilterService;
use App\Services\ProductService;
use App\Services\CategoryService;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService,
        private CategoryService $categoryService,
        private FilterService $filterService
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = $this->filterService->filterByProductNamaOrCategoryNameOrUserName($request->input('search'));

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
    public function store(StoreProductRequest $request)
    {
        $request->validated();

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
    public function update(UpdateProductRequest $request, Product $product)
    {
        $data = $request->safe()->except('image');

        $this->productService->updateProduct(
            $product,
            $data,
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
