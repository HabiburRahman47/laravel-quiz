<?php

namespace App\Http\Controllers\Web\Admin\Category;

use App\DataTables\Category\CategoryDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\API\V1\Admin\Category\UpdateCategoryRequest;
use App\Http\Requests\API\V1\Admin\Section\StoreSectionRequest;
use App\Http\Requests\API\V1\Admin\Section\UpdateSectionRequest;
use App\Models\V1\Category\Category;

class CategoryController extends AdminBaseController
{

    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.categories.index');
    }

    public function create()
    {
        $categories = Category::where('created_by_id', auth()->user()->id)->get();
        return view('admin.categories.create', compact('categories'));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSectionRequest $request
     * @return void
     */
    public function store(StoreCategoryRequest $request)
    {
        $created_by_id = auth()->user()->id;
        $category = new Category();
        $category->fill($request->all());
        $category->created_by_id = $created_by_id;
        $category->save();


        $displayUrl = route('web.admin.categories.show', $category->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' =>$category->id ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return SectionResource
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $categories=Category::get();
        // $this->authorize('show',$category);
        return view('admin.categories.show', compact('category','categories'));
    }

    public function edit($id)
    {
        $categories = Category::where('created_by_id', auth()->user()->id)->get();
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSectionRequest $request
     * @param int $id
     * @return SectionResource
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->fill($request->all());
        $this->authorize('update',$category);
        $category->save();
        $displayUrl = route('web.admin.categories.show', $category->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $category->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete',$category);
        $category->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $category = Category::find($id);
        $this->authorize('trash',$category);
        $category->delete();
        return response()->noContent();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function restore($id)
    {
        //$category = Category::withTrashed()->where('id', $id)->restore();
        $category = Category::withTrashed()->findOrFail($id);
        $this->authorize('restore',$category);
        $category->restore();
        return response('SUCCESSFULLY RESTORED');
    }

}
