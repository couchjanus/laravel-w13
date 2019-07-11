<?php

namespace Werneckbh\Profile\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8|max:255'
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->isCurrentPasswordValid()) {
                $validator->errors()->add('current_password', 'The current password is invalid.');
            }
        });
    }

    /**
     * Validates current password input against Authenticated user's password
     *
     * @return boolean
     */
    protected function isCurrentPasswordValid()
    {
        return Hash::check($this->get('current_password'), Auth::user()->password);
    }
}