<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name'=>Route::CurrentRouteName() == 'auth.admin.register.store'  ? 'required|min:3' : 'nullable',
            'email'=>Route::CurrentRouteName() == 'auth.admin.register.store'  ?  ['required','email','unique:users,email'] : ['required','email'] ,
            'password'=>['required'],
            'confirm_password'=>Route::currentRouteName() == 'auth.admin.register.store' ? 'same:password' :'nullable',
        ];
    }

    public function messages()
    {
        return [
            'full_name.required'=>'Please enter your full name',
            'full_name.min'=>'Full name must contain at least 3 character',
            'email.required'=>'Please enter your email',
            'email.email'=>'Invalid email address',
            'email.unique'=>'Email Already Exists',
            'password.required'=>'Please enter the password',
            'password.min'=>'Password must contain minimim 6 character',
            'password.mixedCase'=>'Password must contain upper and lower case letter',
            'password.numbers'=>'Password must containe at least one number',
            'password.symbols'=>'Password must containe at least one symbol'
        ];
    }
}
