<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\BudgetStoreStepOneRequest;

class BudgetStoreStepTwoRequest extends FormRequest
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
        $rules = [
            'type' => 'required|string|in:web,mobile,desktop',

            'pages_number' => 'required_if:type,web|int',
            'has_login' => 'required_if:type,web|required_if:type,mobile|boolean',
            'has_payment' => 'required_if:type,web|required_if:type,mobile|boolean',
            'browsers' => 'required_if:type,web|array|exists:browsers,id',

            'platform' => 'required_if:type,mobile|in:iOS,Android,iOS and Android',
            'screens_number' => 'required_if:type,mobile|required_if:type,desktop|int',
            
            'supported_os' => 'required_if:type,desktop|in:Windows,Linux,MacOS',
            'supports_prints' => 'required_if:type,desktop|boolean',
            'access_license' => 'required_if:type,desktop|boolean',
        ];

        foreach ((new BudgetStoreStepOneRequest)->rules($this->request) as $key => $value) {
            $rules[$key] = $value;
        }

        return $rules;
    }
}
