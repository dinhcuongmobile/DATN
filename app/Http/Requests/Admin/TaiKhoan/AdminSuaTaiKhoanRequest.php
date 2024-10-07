<?php

namespace App\Http\Requests\Admin\TaiKhoan;

use Illuminate\Foundation\Http\FormRequest;

class AdminSuaTaiKhoanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'ho_va_ten' => 'required|string|max:50',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users,email,' .$id,
                'regex:/^[\w\.\-]+@[a-zA-Z\d\-]+\.[a-zA-Z]{2,}$/',
            ],
            'password' => 'required|min:8|regex:/[A-Z]/|regex:/[a-z]/|regex:/[0-9]/',
            'vai_tro_id' => 'required|exists:vai_tros,id',
            'so_dien_thoai' => 'required|regex:/^0\d{9}$/|unique:users,so_dien_thoai,' .$id,
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            'ho_va_ten.required' => 'Họ và tên không được trống',
            'ho_va_ten.max' => 'Họ và tên không quá 50 ký tự',

            'email.required' => 'Email không được trống',
            'email.regex' => 'Email không hợp lệ',
            'email.max' => 'Email không quá 255 ký tự',
            'email.unique' => 'Email đã tồn tại',
            'email.email' => 'Email sai định dạng',

            'password.required' => 'Mật khẩu không được trống',
            'password.min' => 'Mật khẩu phải ít nhất 8 ký tự',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ cái viết hoa, một chữ cái viết thường, một chữ số',

            'vai_tro_id.required' => 'Vai trò không được trống',
            'vai_tro_id.exists' => 'Vai trò không hợp lệ',

            'so_dien_thoai.required' => 'Số điện thoại không được trống',
            'so_dien_thoai.unique' => 'Số điện thoại đã tồn tại',
            'so_dien_thoai.regex' => 'Số điện thoại phải là số và 10 chữ số  bắt đầu bằng số 0.',
        ];
    }
}
