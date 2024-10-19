<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'login' => ['required', 'string', 'min:3','max:15'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'login.max' => 'Логин должен быть не больше :max символов.',
            'email.required' => 'Email обязателен!',
            'login.required' => 'Логин обязателен!',
            'password.required' => 'Пароль обязателен!',
            'login.min' => 'Логин должен быть не менее :min символов.',
            'password.min' => 'Пароль должен быть не менее :min символов.',
        ];
    }

}
