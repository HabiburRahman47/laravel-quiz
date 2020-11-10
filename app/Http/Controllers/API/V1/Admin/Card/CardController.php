<?php

namespace App\Http\Controllers\API\V1\Admin\Card;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Admin\Card\StoreCardRequest;
use App\Http\Requests\API\V1\Admin\Card\UpdateCardRequest;
use App\Http\Resources\API\V1\Admin\Card\CardCollection;
use App\Http\Resources\API\V1\Admin\Card\CardResource;
use App\Models\V1\Card\Card;
use App\Models\V1\Student\Student;
use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index(Request $request)
    {
        $cards=Card::applyTrashFilterAble()
        ->applyKeywordSearchAble()
        ->applySortAble()
        ->applyPaginateAble();
        return new CardCollection($cards);
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


    public function show($cardId)
    {
        $card=Card::with('cardable')->findOrFail($cardId);
        return new CardResource($card);
    }


    public function update(UpdateCardRequest $request,$cardId)
    {
        $card=Card::findOrFail($cardId);
        $card->fill($request->all());
        $card->save();
        return new CardResource($card);
    }

    public function trash($cardId)
    {
        $card=Card::findOrFail($cardId);
        $card->delete();
        return response()->noContent();
    }

    //restore data
    public function restore($cardId)
    {
        $card=Card::withTrashed()->findOrFail($cardId);
        $card->restore();
        return new CardResource($card);
    }

    public function destroy($cardId){
        $card=Card::onlyTrashed()->where('id',$cardId);
        $card->forceDelete();
        return response()->noContent();
    }
    public function findOutUsers($cardId){
        $card=Card::with('cardable')->findOrFail($cardId);
        // $userId=$card->student->user_id;
        // $user=User::findOrFail($userId);
        return response($card);

    }


}
