<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecruitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     *
     * 
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'createrecruit.title'=> 'string|max:30|required',
            'createrecruit.message'=> 'string|max:200|required',
            'recruitinst'=> 'required:'
        ];
    }
}
