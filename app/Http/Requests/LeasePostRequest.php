<?php

namespace App\Http\Requests;

use App\Models\Leases;
use App\Models\Products;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class LeasePostRequest extends FormRequest
{
    /**
     * @var string|null
     */
    protected $error;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'productId' => 'required|exists:products,id'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'productId.required' => 'Product information is required.',
            'productId.exists'   => 'Invalid product information.',
        ];
    }

    /**
     * custom validation
     * @param $validator
     */
    public function withValidator($validator)
    {
        if (!$validator->fails()) {
            $validator->after(function ($validator) {
                if (Leases::HasLease($this->productId)->count()) {
                    $validator->errors()->add('alredy', 'You already have a lease request!');
                } else if (Products::find($this->productId)->amount == 0) {
                    $validator->errors()->add('stock', 'Sorry, out of stock!');
                }
            });
        }
    }

    /**
     * @return string|null
     */
    public function getValidationError(): ?string
    {
        return $this->error;
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator): void
    {
        $this->error = $validator->errors()->first();
    }
}
