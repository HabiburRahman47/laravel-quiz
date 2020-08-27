<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait SearchAble
{

    /**
     * The attributes that are simply searchable using query as &search_keyword=keyword.
     *
     * @var array
     * @return mixed
     */

    public function scopeApplyKeywordSearch($query)
    {
        $searchKeyword = request()->get("search_keyword");
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