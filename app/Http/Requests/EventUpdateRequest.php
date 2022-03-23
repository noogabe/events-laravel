<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
{
    public function rules()
    {
        return [

            'title' => 'bail|required|max:100',
            'date' => 'required',
            'city' => 'bail|required|max:100',
            'private' => 'boolean',
            'description' => 'bail|required|max:255',
            'items' => 'nullable',
            'image' => 'nullable',

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'O campo título é obrigatório',
            'title.max' => 'Título não pode ter mais de :max caracteres',
            'date.required' => 'O campo data é obrigatório',
            'city.required' => 'O campo cidade é obrigatório',
            'city.max' => 'Cidade não pode ter mais de :max caracteres',
            'private.required' => 'O campo privado é obrigatório',
            'description.required' => 'O campo descrição é obrigatório',
            'description.max' => 'Descrição não pode ter mais de :max caracteres',
        ];
    }
}
