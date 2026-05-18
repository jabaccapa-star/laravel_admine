<?php

namespace De\AdminAuth\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->isAdministrator() ?? false;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userModel = (string) config('auth.providers.users.model');
        $userId = $this->route('user');

        return [
            'name' => ['required', 'string', 'max:255'],
            'login' => ['required', 'string', 'max:255', Rule::unique($userModel, 'login')->ignore($userId)],
            'email' => ['required', 'email', 'max:255', Rule::unique($userModel, 'email')->ignore($userId)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', Rule::in(['user', 'administrator'])],
            'is_blocked' => ['required', 'boolean'],
        ];
    }
}
