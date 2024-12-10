<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RoiAccountabilityReportRequest extends FormRequest
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
            'grant_approval_id' => 'required', 
        ];
    }


      /**
     * Handle a failed validation attempt.
     *
     * @param  Validator  $validator
     * @return void
     */
    protected function failedValidation(Validator $validator)
    {
        // Store free_scheme_details in the session
        session()->flash('product_details', $this->input('product_details', []));
        //  dd(session('free_scheme_details'));
        throw new HttpResponseException(
            redirect()->back()->withErrors($validator)->withInput()
        );
    }
    
}