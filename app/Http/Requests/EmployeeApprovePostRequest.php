<?php

namespace App\Http\Requests;

use App\Models\Leases;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeApprovePostRequest extends FormRequest
{
    /**
     * @var string|null
     */
    protected $error;

    /**
     * @var Leases
     */
    protected $lease;

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
            'leaseId' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'leaseId.required' => 'Lease Id information is required.',
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
                $this->lease = Leases::ApprovalRequests()->find($this->leaseId);
                if (!$this->lease) {
                    $validator->errors()->add('found', 'Approvel request not found!');
                } else if (empty($this->lease->product->amount)) {
                    $validator->errors()->add('stock', 'Out of stock!');
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
     * @return Leases
     */
    public function getLease(): Leases
    {
        return $this->lease;
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator): void
    {
        $this->error = $validator->errors()->first();
    }

}
