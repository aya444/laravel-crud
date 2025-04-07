<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;

interface FilterService
{
    public function filterByProductNamaOrCategoryNameOrUserName(string $search = null): LengthAwarePaginator;
}
