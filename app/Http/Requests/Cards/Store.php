<?php

namespace App\Http\Requests\Cards;

use Closure;
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
            'card_template_id' => [
                'required',
                'numeric',
                'gt:0',
                Rule::exists('card_templates', 'id')->where(function (Builder $query) {
                    return $query->where('status', 'active');
                }),
            ],
            'type' => [
                'required',
                Rule::in([
                    'individual',
                    'group',
                ]),
            ],
            'receiver_name' => 'required|max:100',
            'receiver_email' => 'required|email',
            'user_id' => 'required|numeric|gt:0|exists:users,id',
            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                ]),
            ],
            'scheduled_at' => [
                'required',
                'date',
                'date_format:Y-m-d H:i:s',
                function (
                    string $attribute,
                    mixed $value,
                    Closure $fail
                ) {
                    if ($value < date('Y-m-d H:i:s')) {
                        $fail("The {$attribute} field must be in the future.");
                    }
                }
            ],
        ];
    }
}
