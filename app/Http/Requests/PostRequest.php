<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'content' => 'required|max:140',

            // 画像のバリデーション（画像ファイルがアップロードされている場合）
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            // 動画のバリデーション（動画ファイルがアップロードされている場合）
            'video' => 'nullable|mimes:mp4,avi,mov|max:10000', // 10MBまで
            'tags' => 'nullable|string',
        ];
    }

    public function attributes()
    {
        return [
            'content' => '投稿',
            'image_file' => '画像ファイル',
            'video' => '動画ファイル',
            'tags' => 'タグ',
        ];
    }

}
