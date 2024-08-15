<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'=>'sometimes|string|max:255',
            'slug'=>'sometimes|string|max:255|unique:posts',
            'content'=>'sometimes|string',
            'is-published'=>'sometimes|boolean',
        ];
    }
}
