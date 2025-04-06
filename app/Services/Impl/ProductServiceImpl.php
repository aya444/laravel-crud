<?php

namespace App\Services\Impl;

use App\Services\ProductService;
use App\Models\Product;

use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Storage;

class ProductServiceImpl implements ProductService
{
    public function createProduct(array $data, UploadedFile $image = null): void
    {
        // if image is uploaded, store it
        if ($image) {
            $data['image'] = $image->store('products', 'public');
        }

        Product::create($data);
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
    }

    public function deleteProduct(Product $product): void
    {
        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
    }

    public function getProducts(): LengthAwarePaginator
    {
        // Get last 5 products from DB
        return Product::latest()->paginate(5);
    }
}
