<?php

namespace App\Traits\Filters;

use Illuminate\Http\Request;

trait TrashFilterAble
{
    public function scopeApplyTrashFilterAble($query, $withTrashed = null)
    {
        if (empty($withTrashed)) {
            $withTrashed = request()->input("with_trashed");
        }
        if ($withTrashed == 1 || strtolower($withTrashed) === "true") {
            return $query->withTrashed();
        }
        return $query;
    }
}