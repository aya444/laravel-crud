<?php

namespace App\Services\Impl;

use App\Models\Product;
use App\Services\FilterService;
use Illuminate\Pagination\LengthAwarePaginator;

class FilterServiceImpl implements FilterService
{
    public function filterByProductNamaOrCategoryNameOrUserName(string $search = null): LengthAwarePaginator
    {
        return Product::with(['user', 'categories'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'LIKE', "%$search%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%$search%");
                    })
                    ->orWhereHas('categories', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%$search%");
                    });
            })
            ->latest()
            ->paginate(5)
            ->appends(['search' => $search]);
    }
}
