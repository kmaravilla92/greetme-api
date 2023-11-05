<?php

namespace App\Http\Controllers\Rest;

use App\Http\Controllers\Controller;
use App\Http\Requests\CardTemplates\Store as StoreRequest;
use App\Http\Requests\CardTemplates\Update as UpdateRequest;
use App\Models\CardTemplate;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CardTemplateController extends Controller
{
    protected CardTemplate $card_template;

    protected $response_object = 'Card template';

    public function __construct(CardTemplate $card_template)
    {
        $this->card_template = $card_template;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $templates = $this->card_template->active()->with('parts')->get();

        return $this->successResponse('index', $templates);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $card_template_data = $request->safe()->all();
        $card_template = $this->card_template->create($card_template_data);

        if (!$card_template->id) {
            return $this->failedResponse('store', $card_template_data);
        }

        return $this->successResponse('store', $card_template);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $card_template = $this
                                ->card_template
                                ->where('id', $id)
                                ->active()
                                ->firstOrFail();

            return $this->successResponse('show', $card_template);
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
            $card_template = $this->card_template->where('id', $id)->firstOrFail();
            $card_template_data = $request->safe()->all();

            if (!$card_template->update($card_template_data)) {
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
            $card_template = $this->card_template->where('id', $id)->active()->firstOrFail();

            if (!$card_template->delete()) {
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