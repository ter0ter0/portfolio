<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class ActivityRequest extends FormRequest
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
            'area_id' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'shopName' => 'required',
            'menuName' => 'required',
            'comment' => 'nullable',
            'date' => 'required|date|before_or_equal:' . Carbon::yesterday()->format('Y-m-d'),
        ];
    }

    public function attributes()
    {
        return [
            'area_id' => 'エリア',
            'image' => '画像',
            'shopName' => '店舗名',
            'menuName' => 'メニュー名',
            'comment' => 'コメント',
            'date' => '日付',
        ];
    }
}
