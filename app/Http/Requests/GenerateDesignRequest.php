<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GenerateDesignRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'product_id' => ['required', 'exists:products,id'],
            'product_option_id' => ['nullable', 'exists:product_options,id'],
            'prompt' => ['required', 'string', 'min:10', 'max:5000'],
        ];
    }
}