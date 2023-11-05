<?php

namespace App\Http\Requests\CardTemplateCategories;

use Closure;
use App\Models\CardTemplateCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
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
    public function rules(Request $request): array
    {
        return [
            'name' => 'required|max:100',
            'slug' => 'required|max:200',
            'description' => 'sometimes',
            'parent_id' => [
                'required',
                'numeric',
                'gt:0',
                function (
                    string $attribute,
                    mixed $value,
                    Closure $fail
                ) {
                    if ($value > 0) {
                        $card_template_category = CardTemplateCategory::where('id', $value)
                                                    ->active()
                                                    ->first();
                        if (!$card_template_category) {
                            $fail("The selected {$attribute} is invalid.");
                        } else if ($card_template_category->id === $value) {
                            $fail("The selected {$attribute} is invalid. Avoid setting the {$attribute} into own record.");
                        }
                    }
                }
            ],
            'status' => [
                'required',
                Rule::in([
                    'active',
                    'inactive',
                ]),
            ],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(
            [
                'parent_id' => abs((int) $this->parent_id)
            ]
        );
    }
}
