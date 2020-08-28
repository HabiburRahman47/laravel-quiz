<?php

namespace App\Traits\Filters;

use Illuminate\Http\Request;

trait SearchAble
{

    /**
     * The attributes that are simply searchable using query as &search_keyword=keyword.
     *
     *
     * @param $query
     * @param null $searchKeyword
     * @return mixed
     */

    public function scopeApplyKeywordSearchAble($query, $searchKeyword = null)
    {
        if (empty($searchKeyword)) {
            $searchKeyword = request()->input("search_keyword");
        }
        return $query->where(function ($q) use ($searchKeyword) {

            for ($i = 0; $i < sizeof($this->searchable); $i++) {
                $searchField = $this->searchable[$i];
                if ($i == 0) {
                    $q->where($searchField, 'LIKE', "%$searchKeyword%");
                } else {
                    $q->orWhere($searchField, 'LIKE', "%$searchKeyword%");
                }
            }
            return $q;
        });
    }
}