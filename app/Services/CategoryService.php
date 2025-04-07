<?php

namespace App\Services;

use App\Models\category;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;

interface CategoryService
{
    public function createCategory(array $data): void;
    public function updateCategory(Category $category, array $data): void;
    public function deleteCategory(Category $category): void;
    public function getCategories(): LengthAwarePaginator;
}
