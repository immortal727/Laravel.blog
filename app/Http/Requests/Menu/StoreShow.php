<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class StoreShow extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'show_item' => 'boolean',
        ];
    }
}
