<?php

namespace App\Http\Requests\CardSigns;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Store extends FormRequest
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
    public function rules(): array
    {
        return [
            'card_id' => [
                'required',
                'numeric',
                Rule::exists('cards', 'id')->where(function (Builder $query) {
                    return $query->where('status', 'active');
                }),
            ],
            'user_id' => 'required|numeric|gt:0|exists:users,id',
            'message' => 'required|max:300',
            'custom_name' => 'required|max:100',
            'font_family_id' => 'required|numeric|gt:0',
            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                ]),
            ],
        ];
    }
}
