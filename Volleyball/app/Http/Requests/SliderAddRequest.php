<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
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
            'name' => 'bail|required|unique:products|max:255',
            'description' => 'required',
            'image_path' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên Slider ko được trống',
            'name.unique' => 'Tên Slider ko được trùng',
            'name.max' => 'Tên Slider ko được quá 255 ký tự',
            'name.min' => 'Tên Slider ko được ít hơn 10 ký tự',
            'description.required' => 'Mô tả ko được trống',
            'image_path.required' => 'Hình ảnh ko được trống',


        ];
    }
}
