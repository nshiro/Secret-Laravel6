<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveMessage extends FormRequest
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
            'user_id'   => 'required|exists:users,id',
            'title'     => 'required|max:255',
            'content'   => 'required|max:50000',
        ];
    }

    /**
     * カスタムエラーメッセージ
     */
    public function messages()
    {
        return [
            'user_id.required' => '誰宛かを選択して下さい。',
        ];
    }

    /**
     * 項目の日本語設定
     */
    public function attributes()
    {
        return [
            'user_id' => '誰宛',
            'title'   => 'タイトル',
            'content' => '本文',
        ];
    }
}
