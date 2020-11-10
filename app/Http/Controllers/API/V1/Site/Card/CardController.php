<?php

namespace App\Http\Controllers\API\V1\Site\Card;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\Site\Card\CardRequest;
use App\Http\Requests\API\V1\Site\Card\StoreCardRequest;
use App\Http\Requests\API\V1\Site\Card\UpdateCardRequest;
use App\Http\Resources\API\V1\Site\Card\CardCollection;
use App\Http\Resources\API\V1\Site\Card\CardResource;
use App\Models\V1\Card\Card;
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


    public function store(StoreCardRequest $request)
    {
        $card=new Card();
        $card->fill($request->all());
        $card->save();
        return new CardResource($card);
    }


    public function show($cardId)
    {
        $card=Card::with('student')->findOrFail($cardId);
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


}
