<?php

namespace App\Http\Controllers\Rest;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardTemplateCategories\Store as StoreRequest;
use App\Http\Requests\CardTemplateCategories\Update as UpdateRequest;
use App\Models\CardTemplateCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CardTemplateCategoryController extends Controller
{
    protected CardTemplateCategory $card_template_category;

    protected $response_object = 'Card template category';

    public function __construct(CardTemplateCategory $card_template_category)
    {
        $this->card_template_category = $card_template_category;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $card_template_categorys = $this->card_template_category->active()->get();
        
        return $this->successResponse('index', $card_template_categorys);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $card_data = $request->safe()->all();
        $card_template_category = $this->card_template_category->create($card_data);

        if (!$card_template_category->id) {
            return $this->failedResponse('store');
        }

        return $this->successResponse('store', $card_template_category);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $card_template_category = $this->card_template_category->where('id', $id)->active()->firstOrFail();

            return $this->successResponse('show', $card_template_category);
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
            $card_template_category = $this->card_template_category->where('id', $id)->firstOrFail();
            $card_data = $request->safe()->all();

            if (!$card_template_category->update($card_data)) {
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
            $card_template_category = $this->card_template_category->where('id', $id)->active()->firstOrFail();

            if (!$card_template_category->delete()) {
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