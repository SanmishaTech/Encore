<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerTrackingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'proposal_date' => ['required'],
            'primary' => ['required'],
            'secondary' => ['required'],
            // 'doctor_id' => ['required'],
            // 'product_id' => ['required'],
            // 'm_1' => ['required'],
            // "`product_details[${productDetail.id}][doctor_id]`" => ['required'],
        ];
    }
}
