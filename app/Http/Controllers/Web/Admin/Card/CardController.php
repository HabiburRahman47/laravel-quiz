<?php

namespace App\Http\Controllers\Web\Admin\Card;

use App\DataTables\Card\CardDataTable;
use App\Http\Controllers\Web\Admin\AdminBaseController;
use App\Http\Requests\API\V1\Admin\Card\StoreCardRequest;
use App\Http\Requests\API\V1\Admin\Card\UpdateCardRequest;
use App\Models\V1\Card\Card;
use App\Models\V1\Student\Student;

class CardController extends AdminBaseController
{

    public function index(CardDataTable $dataTable)
    {
        return $dataTable->render('admin.cards.index');
    }

    public function create()
    {
        // $categories = Category::where('created_by_id', auth()->user()->id)->get();
        $students=Student::where('user_id', auth()->user()->id)->get();
        return view('admin.cards.create',compact('students'));        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSectionRequest $request
     * @return void
     */
    public function store(StoreCardRequest $request)
    {
        $student=Student::findOrFail(request('cardable_id'));
        $card = new Card();
        $card->fill($request->all());
        $student->cards()->save($card);


        $displayUrl = route('web.admin.cards.show', $card->id);
        $this->flashStoredMsg($displayUrl);
        return redirect()->back()->with(['rID' =>$card->id ]);
    }
    public function storeStudentToCards(StoreCardRequest $request,$studentId)
    {
        $student=Student::findOrFail($studentId);
        $card=new Card();
        $card->fill($request->all());
        $student->cards()->save($card);
        // $card->save();
        // return new CardResource($card);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return SectionResource
     */
    public function show($id)
    {
        $card = Card::findOrFail($id);
        // $this->authorize('show',$card);
        return view('admin.cards.show', compact('card'));
    }

    public function edit($id)
    {
        // $categories = Category::where('created_by_id', auth()->user()->id)->get();
        $card = Card::with('cardable')->findOrFail($id);
        return view('admin.cards.edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateSectionRequest $request
     * @param int $id
     * @return SectionResource
     */
    public function update(UpdateCardRequest $request, $id)
    {
        $card = Card::findOrFail($id);
        $card->fill($request->all());
        // $this->authorize('update',$card);
        $card->save();
        $displayUrl = route('web.admin.cards.show', $card->id);
        $this->flashUpdatedMsg($displayUrl);
        return redirect()->back()->with(['rID' => $card->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $card = Card::withTrashed()->findOrFail($id);
        $this->authorize('forceDelete',$card);
        $card->forceDelete();
        return response('PERMANENTLY DELETED');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function trash($id)
    {
        $card = Card::find($id);
        $this->authorize('trash',$card);
        $card->delete();
        return response()->noContent();
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function restore($id)
    {
        //$card = Card::withTrashed()->where('id', $id)->restore();
        $card = Card::withTrashed()->findOrFail($id);
        $this->authorize('restore',$card);
        $card->restore();
        return response('SUCCESSFULLY RESTORED');
    }

}
