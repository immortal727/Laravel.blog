<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePost extends FormRequest
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
        $rules = [
            'name' => 'required',
            'quote' => 'required',
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|integer',
            'thumbnail' => 'nullable|image',
        ];

        if ($this->routeIs('post.update')) {
            $rules['slug'] = [
                'required',
                'string',
                Rule::unique(Post::class, 'slug')
                    ->ignoreModel($this->route('post')),
            ];
        }

        return $rules;
    }
   /* public function rules()
    {
        $unique = Rule::unique('posts')->ignoreModel($this->route('posts.update'));
        return [
            'name' => 'required',
            'quote' => 'required',
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required|integer',
            'thumbnail' => 'nullable|image',
            'slug' => ['required', 'string', $unique],
        ];
    }*/
}
