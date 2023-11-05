<?php

namespace App\Http\Requests\CardTemplateCategories;

use App\Models\CardTemplateCategory;
use Closure;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class Update extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(
        Request $request,
        Store $store
    ): array
    {
        return $store->rules($request);
    }
}
