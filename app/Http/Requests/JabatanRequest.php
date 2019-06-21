<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class JabatanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdmin;
    }

    protected $rules = [
        'nama_jabatan' => ''
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
            $rules['nama_jabatan'] = ['required', 'unique:jabatans'];
        } else if ($this->isMethod('PUT')) {
            $rules['nama_jabatan'] = ['required', 'unique:jabatans,nama_jabatan,'.$this->get('id')];        
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'nama_jabatan.required' => 'Nama Jabatan harus diisi!',
            'nama_jabatan.unique' => 'Nama Jabatan sudah digunakan!',
        ];
    }
}
