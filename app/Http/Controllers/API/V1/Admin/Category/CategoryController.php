<?php

namespace App\Http\Controllers\API\V1\Admin\Category;

use App\Http\Controllers\API\V1\Admin\AdminAPIBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\API\V1\Admin\Category\UpdateCategoryRequest;
use App\Http\Resources\API\V1\Admin\Category\CategoryCollection;
use App\Http\Resources\API\V1\Admin\Category\CategoryResource;
use App\Models\V1\Category\Category;
use Illuminate\Http\Request;

class CategoryController extends AdminAPIBaseController
{


    public function index()
    {
        $categories=Category::applyTrashFilterAble()
                             ->applyKeywordSearchAble()
                             ->applySortAble()
                             ->applyPaginateAble();
        return new CategoryCollection($categories);
    }


    public function store(StoreCategoryRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $category=new Category();
        $category->fill($request->all());
        $category->created_by_id=$created_by_id;
        $category->save();
        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($categoryId)
    {
        $category=Category::findOrFail($categoryId);
        return new CategoryResource($category);
    }


    public function update(UpdateCategoryRequest $request,$categoryId)
    {
        $category=Category::findOrFail($categoryId);
        $category->fill($request->all());
        $this->authorize('update',$category);
        $category->save();
        return new CategoryResource($category);
    }

    public function trash($categoryId)
    {
        $category=Category::findOrFail($categoryId);
        $this->authorize('trash',$category);
        $category->delete();
        return response()->noContent();
    }

    //restore data
    public function restore($categoryId)
    {
        $category=Category::withTrashed()->findOrFail($categoryId);
        $this->authorize('restore',$category);
        $category->restore();
        return new CategoryResource($category);
    }

    public function destroy($categoryId){
        $category=Category::withTrashed()->findOrFail($categoryId);
        $this->authorize('forceDelete',$category);
        $category->forceDelete();
        return response()->noContent();
    }
}
