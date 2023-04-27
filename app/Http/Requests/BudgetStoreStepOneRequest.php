<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\StringHasOnlyNumbers;

class BudgetStoreStepOneRequest extends FormRequest
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
            'name' =>  'required|max:255',
            'email' => 'required|email|max:255|unique:customers',
            'phone' => ['required', 'string', 'max:13', new StringHasOnlyNumbers()],
            'address' => 'required|max:255'
        ];
    }
}
