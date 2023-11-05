<?php

namespace App\Http\Controllers\REST;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cards\Store as StoreRequest;
use App\Http\Requests\Cards\Update as UpdateRequest;
use App\Models\Card;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class CardController extends Controller
{
    protected Card $card;

    protected $response_object = 'Card';

    public function __construct(Card $card)
    {
        $this->card = $card;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = $this->card->active()->get();
        
        return $this->successResponse('index', $cards);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(
        StoreRequest $request
    )
    {
        $card_data = $request->safe()->all();
        $card = $this->card->create($card_data);

        if (!$card->id) {
            return $this->failedResponse('store');
        }

        return $this->successResponse('store', $card);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $card = $this->card->where('id', $id)->active()->firstOrFail();

            return $this->successResponse('show', $card);
        } catch(ModelNotFoundException $e) {
            return $this->failedResponse(
                'show',
                compact('id'),
                status_code: Response::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateRequest $request,
        int $id
    )
    {
        $response_data = compact('id');

        try {
            $card = $this->card->where('id', $id)->firstOrFail();
            $card_data = $request->safe()->all();

            if (!$card->update($card_data)) {
                return $this->failedResponse('update', $response_data);
            }

            return $this->successResponse('update', $response_data);
        } catch(ModelNotFoundException $e) {
            return $this->failedResponse(
                'show',
                $response_data,
                status_code: Response::HTTP_NOT_FOUND
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $response_data = compact('id');

        try {
            $card = $this->card->where('id', $id)->active()->firstOrFail();

            if (!$card->delete()) {
                return $this->failedResponse('destroy', $response_data);
            }
            
            return $this->successResponse('destroy', $response_data);
        } catch(ModelNotFoundException $e) {
            return $this->failedResponse(
                'show',
                $response_data,
                status_code: Response::HTTP_NOT_FOUND
            );
        }
    }
}