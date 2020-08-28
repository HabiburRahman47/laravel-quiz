<?php

namespace App\Traits\Filters;

use Illuminate\Support\Str;

trait SortAble
{
    /**
     * Checks if a column is sortable
     */
    public function isColumnSortable($column)
    {
        if (!isset($this->sortable)) {
            $this->sortable = [];
        }
        return in_array($column, $this->sortable);
    }

    /**
     * Sort the Items by a specific column
     * Optionally sort in a specific direction
     * sort_by=columnName&sort_direction=asc
     * @param $query
     * @param $column
     * @param $sortDirection
     * @return mixed
     */
    public function sortColumnBy($query, $column, $sortDirection)
    {
        // Check if pre-defined orderBy method exists to sort by
        if (method_exists($this, $method = 'orderBy' . Str::studly($column))) {
            return $this->$method();
        }
        return $this->isColumnSortable($column) ? $query->orderBy($column, $sortDirection) : $query->latest();
    }

    public function scopeApplySortAble($query, $column = null, $sortDirection = null)
    {
        if (empty($column)) {
            $column = request()->input('sort_by');
        }
        if (empty($sortDirection)) {
            $sortDirection = request()->input('sort_direction');
        }
        if (!empty($column) && !empty($sortDirection)) {
            return $this->sortColumnBy($query, $column, $sortDirection);
        }

        $latest = true;
        if (request()->has("with_latest")) {
            $latest = filter_var(request()->get("with_latest"), FILTER_VALIDATE_BOOLEAN);
        }

        if ($latest) {
            return $query->latest();
        }

    }
}