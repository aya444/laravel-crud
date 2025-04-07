<?php

namespace App\Services;

use App\Models\category;

use Illuminate\Pagination\LengthAwarePaginator;
use \Illuminate\Database\Eloquent\Collection;

interface CategoryService
{
    public function createCategory(array $data): void;
    public function updateCategory(Category $category, array $data): void;
    public function deleteCategory(Category $category): void;
    public function getCategories(): LengthAwarePaginator;
    public function getAllCategories(): Collection;
}
