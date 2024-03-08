<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetroLineRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required'],
        ];
    }

    public function authorize()
    {
        return true;
    }
}
