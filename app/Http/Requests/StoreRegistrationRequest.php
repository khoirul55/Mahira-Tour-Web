<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'schedule_id' => 'required|exists:schedules,id',
            'full_name' => 'required|string|min:3|max:255',
            'phone' => ['required', 'string', 'min:10', 'max:15', 'regex:/^(\+62|62|0)8[1-9][0-9]{6,11}$/'],
            'email' => 'required|email:dns,spoof|max:255',
            'num_people' => 'required|integer|between:1,10',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    public function messages()
    {
        return [
            'schedule_id.required' => 'Mohon pilih jadwal keberangkatan.',
            'schedule_id.exists' => 'Jadwal yang dipilih tidak tersedia.',
            'full_name.required' => 'Nama lengkap wajib diisi.',
            'phone.required' => 'Nomor WhatsApp wajib diisi.',
            'phone.regex' => 'Format nomor WhatsApp tidak valid. Gunakan format 08xx atau 628xx.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'num_people.required' => 'Jumlah jamaah wajib diisi.',
            'num_people.between' => 'Jumlah jamaah minimal 1 dan maksimal 10 orang per pendaftaran.',
        ];
    }

    /**
     * Prepare inputs for validation.
     */
    protected function prepareForValidation()
    {
        // Sanitize phone number
        if ($this->phone) {
            $phone = preg_replace('/[^0-9]/', '', $this->phone);
            if (str_starts_with($phone, '62')) {
                $phone = '0' . substr($phone, 2);
            }
            $this->merge(['phone' => $phone]);
        }

        // Title case for name
        if ($this->full_name) {
            $this->merge(['full_name' => ucwords(strtolower($this->full_name))]);
        }
    }
}
