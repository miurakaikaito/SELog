<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class DailyReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // falseの場合、403ステータスコードを返却する
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
            'reporting_time' => 'required|before_or_equal:today',
            'title'          => 'required|max:255',
            'contents'       => 'required|max:1000',
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
            'required'        => '入力必須の項目です。',
            'max'             => ':max文字以内で入力してください。',
            'before_or_equal' => '今日以前の日付を選択してください。',
        ];
    }
}
