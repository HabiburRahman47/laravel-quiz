<?php

namespace App\Traits\Filters;

use Illuminate\Http\Request;

trait PaginateAble
{
    public function scopeApplyPaginateAble($query, $perPage = null, $limit = 50)
    {
        if (empty($perPage)) {
            $perPage = (int)request()->input("per_page", 10);
            if ($perPage > $limit) {
                $perPage = $limit;
            }
        }

        return $query->paginate($perPage);
    }
}