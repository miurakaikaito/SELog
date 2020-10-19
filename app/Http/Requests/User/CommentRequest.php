<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'content'     => 'required|max:1000',
            'question_id' => 'required|exists:questions,id,deleted_at,NULL',
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
            'exists'                   => 'カテゴリが存在しません。',
            'tag_category_id.required' => '選択必須の項目です。',
            'required'                 => '入力必須の項目です。',
            'max'                      => ':max文字以内で入力してください。',
        ];
    }
}
