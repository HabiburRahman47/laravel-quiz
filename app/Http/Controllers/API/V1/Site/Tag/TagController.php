<?php

namespace App\Http\Controllers\API\V1\Site\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Site\Tag\StoreTagRequest;
use App\Http\Requests\API\V1\Site\Tag\UpdateTagRequest;
use Spatie\Tags\Tag;

use function GuzzleHttp\Promise\all;

class TagController extends Controller
{


    public function store(StoreTagRequest $request)
    {
        $tag = Tag::create($request->all());
        return response($tag);
    }


    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return response($tag);
    }

    public function update(UpdateTagRequest $request, $id)
    {
        $tag = Tag::findFromString($request->oldName);
        $tag->name=$request->newName;
        $tag->save();
        return response($tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
    }
}
