<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdmin;
        // return true;
    }

    protected $rules = [
        'id_unit' => 'required',
        'id_jabatan' => 'required',
        'nik' => '',
        'nama_user' => 'required',
        'email' => '',
        'password' => 'required|sometimes'
    ];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = $this->rules;

        if ($this->isMethod('POST')) {
            $rules['nik'] = 'required|regex:/[0-9 ]+/|size:7|unique:users';
            $rules['email'] = 'required|email|unique:users';
        } else if ($this->isMethod('PUT')) {
            $rules['nik'] = 'required|regex:/[0-9 ]+/|size:7|unique:users,nik,'.$this->get('id');
            $rules['email'] = 'required|email|unique:users,email,'.$this->get('id');
        }

        return $rules;
        
    }

    public function messages()
    {
        return [
            'id_unit.required' => 'Unit harus diisi!',
            'id_jabatan.required' => 'Jabatan harus diisi!',
            'nama_user.required' => 'Nama user harus diisi!',
            'nik.required' => 'NIK harus diisi!',
            'nik.regex' => 'NIK hanya boleh menggunakan angka!',
            'nik.size' => 'NIK hanya 7 karakter!',
            'nik.unique' => 'NIK sudah digunakan!',
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Format email tidak sesuai!',
            'email.unique' => 'Email sudah digunakan!',
            'password.required' => 'Password harus diisi!',
        ];
    }
}
