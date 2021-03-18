<?php

namespace App\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreate extends FormRequest
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
            'name' => 'required',
            'type' => 'required',
            'home' => 'in:1,0',
            'post_id' => 'required_without:post_id, category_id, external_link',
            'category_id' => 'required_without:post_id, category_id, external_link',
            'external_link' => 'required_without:post_id, category_id, external_link',
        ];
    }
}
