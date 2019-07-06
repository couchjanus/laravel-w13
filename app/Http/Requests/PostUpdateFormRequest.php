<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostUpdateFormRequest extends FormRequest
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
            'content' => 'required',
            'title' => 'required|string', Rule::unique('posts')->ignore($this->title)
        ];
    }
    
    public function messages()
    {
        return [
            'title.required' => 'The :attribute field is required!',
            'content.required' => 'The :attribute field is required.'
        ];
    }
    /**
     *  Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'title' => 'trim|capitalize|escape',
        ];
    }
}
