<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LottoTypeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

     /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'digits_range' => [
                                'min' => $this->digits_range[0],
                                'max' => $this->digits_range[1],
                            ],
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'combination_count' => 'required',
            'digits_range' => 'required',
            'color_theme' => 'required|max:255',
        ];
    }
}
