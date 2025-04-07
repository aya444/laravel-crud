<?php

namespace App\Services\Impl;

use App\Services\CategoryService;
use App\Models\Category;

use Illuminate\Pagination\LengthAwarePaginator;

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
        return Category::with('user') // Eager load the user relationship for better performance
            ->latest()
            ->paginate(5);
    }
}
