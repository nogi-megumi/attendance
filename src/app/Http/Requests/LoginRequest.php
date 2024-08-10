<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;

class LoginRequest extends FortifyLoginRequest
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
        return [
            'email' => ['required', 'email', 'string', 'max:191'],
            'password' => ['required', 'min:8', 'max:191'],
        ];
    }
    // public function messages()
    // {
    //     return [
    //         'email.required' => 'メールアドレスは、必ず入力してください。',
    //         'email.email' => 'メールアドレスは、有効なメールアドレス形式で入力してください。',
    //         'password.required' => 'パスワードは、必ず入力してください。'
    //     ];
    // }
}
