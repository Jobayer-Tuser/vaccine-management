<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserDetailsRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'. UserProfile::class],
            'nid'       => ['required', 'digits_between:10,11', 'unique:'. UserProfile::class],
            'phone'     => ['required', 'digits_between:10,11', 'unique:'. UserProfile::class],
            'vaccination_center_id' => ['required', 'integer' ],
        ];
    }
}
