<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /** @var string */
    private $modelName = 'user';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var User */
        $user = Auth::user();

        return $user->admin || $user->hasPermissionTo('create_' . $this->modelName);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'max:100', Rule::unique('users', 'email')],
            'username' => ['required', 'string', 'max:30', Rule::unique('users', 'username')],
            'is_admin' => ['nullable', 'boolean'],
            'password' => ['required', 'confirmed', Password::defaults()]
        ];
    }
}
