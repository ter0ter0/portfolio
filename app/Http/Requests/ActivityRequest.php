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
            'shop_name' => 'required',
            'menu_name' => 'required',
            'comment' => 'nullable',
            'date' => 'required|date|before_or_equal:' . Carbon::yesterday()->format('Y-m-d'),
        ];

        // 新規登録時と更新時で条件分岐
        $rulesImageExist = 'required';
        if ($this->isMethod('put')) {
            $rulesImageExist = 'nullable';
        }
        $rules['image'] = $rulesImageExist . '|image|mimes:jpg,jpeg,png|max:2048';
        return $rules;
    }

    public function attributes()
    {
        return [
            'area_id' => 'エリア',
            'image' => '画像',
            'shop_name' => '店舗名',
            'menu_name' => 'メニュー名',
            'comment' => 'コメント',
            'date' => '日付',
        ];
    }
}
