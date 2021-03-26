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
        /*$menu = [
            'type' => 'page_link',
            'post' => 'page_link',
            'category' => 'category_link',
            'link' => 'external_link',
        ];*/
        return [
           /* $menu,
            [
                'type' => 'required|string',
                'post_id' => 'required_if:type,post',
                'category_id' => 'required_if:type,category',
                'external_link' => 'required_if:type,link',
            ],*/
            'type' => 'required|string',
            'post_id' => 'required_if:type,post',
            'category_id' => 'required_if:type,category',
            'external_link' => 'required_if:type,link',
            'name' => 'required',
            'home' => 'in:1,0',
        ];
    }
}

/*   'post_id' => 'required_if:type,page_link',
            'category_id' => 'required_if:type,category_link',
            'external_link' => 'required_if:type,external_link',*/

/* 'post_id' => 'required_with:category_id,external_link | string',
 'category_id' => 'required_with:post_id,external_link | string',
 'external_link' => 'required_with:post_id,category_id | string',*/
