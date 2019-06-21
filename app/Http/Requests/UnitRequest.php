<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Auth;

class UnitRequest extends FormRequest
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
        'nama_unit' => '',
        'nama_folder' => 'required'
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
            $rules['nama_unit'] = 'required|min:2|unique:units';
        } else if ($this->isMethod('PUT')) {
            $rules['nama_unit'] = 'required|min:2|unique:units,nama_unit,'.$this->get('id');
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'nama_unit.required' => 'Nama Unit harus diisi!',
            'nama_unit.min' => 'Nama Unit minimal 2 Karakter!',
            'nama_unit.unique' => 'Nama Unit sudah digunakan!',
            'nama_folder.required' => 'Nama Folder harus diisi!'
        ];
    }
}
