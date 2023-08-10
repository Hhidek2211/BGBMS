<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //public function authorize()
    //{
    //    return false;
    //}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'edituser.name' => 'required|string|max:10',
            'edituser.grade' => 'required|integer|min:1',
            'edituser.introduction' => 'required|string|max:200',
            'instrument' => 'required',
            'edituser.user_id' => 'unique:user_profiles,user_id'
        ];
    }
}
