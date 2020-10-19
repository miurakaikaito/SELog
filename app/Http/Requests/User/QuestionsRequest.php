<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class QuestionsRequest extends FormRequest
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
            'tag_category_id'     => 'required|exists:tag_categories,id,deleted_at,NULL',
            'title'               => 'required|max:255',
            'content'             => 'required|max:1000'
        ];
    }

    /**
     * custom message
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required'    => '入力必須の項目です。',
            'max'         => ':max文字以内で入力してください。',
            'exists'      => 'カテゴリが存在しません。',
        ];
    }
}
