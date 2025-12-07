<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name'        => ['required', 'string', 'max:255'],
            'price'       => ['required', 'integer', 'between:0,10000'],
            'image'       => ['required', 'image', 'mimes:jpeg,png', 'max:2048'],
            'seasons'     => ['required', 'array'],
            'seasons.*'   => ['integer', 'exists:seasons,id'],
            'description' => ['required', 'string', 'max:120'],
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'        => '商品名を入力してください',
            'price.required'       => '値段を入力してください',
            'price.integer'        => '数値を入力してください',
            'price.between'        => '0〜10000円以内で入力してください',
            'image.required'       => '商品画像を登録してください',
            'image.image'          => '画像ファイルを選択してください',
            'image.mimes'          => '「.png」または「.jpeg」形式でアップロードしてください',
            'image.max'            => '画像サイズが大きすぎます（2MB以内）',
            'seasons.required'     => '季節を選択してください',
            'seasons.array'        => '季節の選択が不正です',
            'seasons.*.exists'     => '不正な季節が選択されています',
            'description.required' => '商品説明を入力してください',
            'description.max'      => '商品説明は120文字以内で入力してください',
        ];
    }
}
