<?php

namespace App\Services\Impl;

use App\Models\Product;

use App\Services\ProductService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductServiceImpl implements ProductService
{
    public function createProduct(array $data, UploadedFile $image = null): void
    {
        // if image is uploaded, store it
        if ($image) {
            $data['image'] = $image->store('products', 'public');
        }

        $product = Product::create($data);

        if(array_key_exists('categories', $data)) {
            $product->categories()->attach($data['categories']);
        }
    }


    public function updateProduct(Product $product, array $data, UploadedFile $image = null): void
    {
        if ($image) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Store new image
            $data['image'] = $image->store('products', 'public');
        }

        $product->update($data);

        if(array_key_exists('categories', $data)) {
            $product->categories()->sync($data['categories']);
        }
    }

    public function deleteProduct(Product $product): void
    {
        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->categories()->detach();

        $product->delete();
    }

    public function getProducts(): LengthAwarePaginator
    {
        // Get last 5 products from DB
        return Product::with('user') // Eager load the user relationship for better performance
            ->latest()
            ->paginate(5);
    }
}
