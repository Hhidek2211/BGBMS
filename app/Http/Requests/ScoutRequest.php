<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ScoutRequest extends FormRequest
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
            'scout.title'=> 'string|max:30|required',
            'scout.message'=> 'string|max:200|required',
            'userid'=> Rule::unique('scouts', 'user_profile_id')
                    -> where('band_profile_id', $this->input('bandid'))
        ];
    }
}
