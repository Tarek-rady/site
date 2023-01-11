<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ImportFileRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
       return [
        'file' => ['required', 'file', 'mimes:csv,xlsx']
    ];
    }
}
