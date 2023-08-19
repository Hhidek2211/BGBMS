<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppRequest extends FormRequest
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
            'application.appinstid'=> 'required',
            'application.message'=> 'required|string|max:200',
            //'application.user_profile_id'=> Rule::unique('applications','recruitment_id')     同じユーザーが同じ募集に応募することを禁止したいが、うまくできないし優先度低いのでいったん凍結
            //                        ->where('user_profile_id', $input('user_profile_id')),
        ];
    }
}
