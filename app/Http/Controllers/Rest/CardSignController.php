<?php

namespace App\Http\Controllers\Rest;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardSigns\Store as StoreRequest;
use App\Http\Requests\CardSigns\Update as UpdateRequest;
use App\Models\CardSign;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CardSignController extends Controller
{
    protected CardSign $card_sign;

    protected $response_object = 'Card sign';

    public function __construct(CardSign $card_sign)
    {
        $this->card_sign = $card_sign;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $card_signs = $this->card_sign->active()->get();
        
        return $this->successResponse('index', $card_signs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $card_data = $request->safe()->all();
        $card_sign = $this->card_sign->create($card_data);

        if (!$card_sign->id) {
            return $this->failedResponse('store');
        }

        return $this->successResponse('store', $card_sign);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $card_sign = $this->card_sign->where('id', $id)->active()->firstOrFail();

            return $this->successResponse('show', $card_sign);
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
            $card_sign = $this->card_sign->where('id', $id)->firstOrFail();
            $card_data = $request->safe()->all();

            if (!$card_sign->update($card_data)) {
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
            $card_sign = $this->card_sign->where('id', $id)->active()->firstOrFail();

            if (!$card_sign->delete()) {
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