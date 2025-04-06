<?php

namespace App\Services;

use App\Models\Product;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;

interface ProductService
{
    public function createProduct(array $data, UploadedFile $image = null): void;
    public function updateProduct(Product $product, array $data, UploadedFile $image = null): void;
    public function deleteProduct(Product $product): void;
    public function getProducts(): LengthAwarePaginator;
}
