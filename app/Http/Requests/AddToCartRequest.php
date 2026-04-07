<?php

namespace App\Http\Requests;

use App\Models\CustomProductSession;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class AddToCartRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'product_option_id' => ['nullable', 'exists:product_options,id'],
            'custom_product_session_id' => ['nullable', 'exists:custom_product_sessions,id'],
            'quantity' => ['nullable', 'integer', 'min:1'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $session_id = $this->input('custom_product_session_id');

            if (!$session_id) {
                return;
            }

            $session = CustomProductSession::find($session_id);

            if (!$session) {
                return;
            }

            if ((int) $session->user_id !== (int) $this->user()->id) {
                $validator->errors()->add('custom_product_session_id', 'This customization session does not belong to you.');
            }

            if ((int) $session->product_id !== (int) $this->input('product_id')) {
                $validator->errors()->add('custom_product_session_id', 'Customization session does not match the selected product.');
            }

            if (
                $this->filled('product_option_id') &&
                (int) $session->product_option_id !== (int) $this->input('product_option_id')
            ) {
                $validator->errors()->add('product_option_id', 'Selected option does not match the customization session.');
            }
        });
    }
}