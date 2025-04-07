<?php

namespace App\Services\Impl;

use App\Services\CategoryService;
use App\Models\Category;

use Illuminate\Pagination\LengthAwarePaginator;
use \Illuminate\Database\Eloquent\Collection;

class CategoryServiceImpl implements CategoryService
{
    public function createCategory(array $data): void
    {
        Category::create($data);
    }


    public function updateCategory(Category $category, array $data): void
    {
        $category->update($data);
    }

    public function deleteCategory(Category $category): void
    {
        $category->delete();
    }

    public function getCategories(): LengthAwarePaginator
    {
        // Get last 5 categories from DB
        return Category::with('products.user') // Eager load the user relationship for better performance
            ->latest()
            ->paginate(5);
    }

    public function getAllCategories(): Collection
    {
        return Category::all();
    }
}
