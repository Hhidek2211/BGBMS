<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class BandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //dd($this['editband']['name']),
            'editband.name' => ['required',
                                'string',
                                'max:20',
                                Rule::unique('band_profiles','name')-> ignore($this['editband']['name'], 'name'),
                                ],
            'editband.introduction' => 'required|string|max:200',
            'bandmember' => 'required',
        ];
    }
}
