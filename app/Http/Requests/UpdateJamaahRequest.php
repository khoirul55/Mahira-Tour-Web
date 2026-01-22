<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateJamaahRequest extends FormRequest
{
    public function authorize()
    {
        // Setup authorization check here or rely on Controller's check
        // For now true, as we validate token in controller/middleware
        return true; 
    }

    public function rules()
    {
        return [
            'title' => ['required', Rule::in(['Tn.', 'Ny.', 'Nn.'])],
            'full_name' => 'required|string|min:3|max:100',
            'nik' => 'required|numeric|digits:16', 
            'birth_place' => 'required|string|max:50',
            'birth_date' => 'required|date|before:today',
            'gender' => ['required', Rule::in(['L', 'P'])],
            'marital_status' => ['required', Rule::in(['single', 'married', 'divorced', 'widowed'])],
            'father_name' => 'required|string|min:3',
            'occupation' => 'required|string',
            'blood_type' => ['nullable', Rule::in(['A', 'B', 'AB', 'O', '-'])],
            'address' => 'required|string|min:10',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
            'emergency_name' => 'required|string|min:3',
            'emergency_relation' => 'required|string',
            'emergency_phone' => ['required', 'string', 'min:9', 'max:15'],
        ];
    }

    public function messages()
    {
        return [
            'nik.digits' => 'NIK harus berjumlah 16 digit.',
            'nik.numeric' => 'NIK harus berupa angka.',
            'birth_date.before' => 'Tanggal lahir tidak valid.',
            'gender.in' => 'Pilih jenis kelamin Laki-laki atau Perempuan.',
        ];
    }
    
    protected function prepareForValidation()
    {
        if ($this->full_name) {
            $this->merge(['full_name' => ucwords(strtolower($this->full_name))]);
        }
        
        if ($this->father_name) {
             $this->merge(['father_name' => ucwords(strtolower($this->father_name))]);
        }
    }
}
