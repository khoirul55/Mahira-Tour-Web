<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SingleRegistrationExport implements FromCollection, WithHeadings, WithMapping, WithTitle, ShouldAutoSize, WithStyles
{
    protected $registration;
    
    public function __construct(Registration $registration)
    {
        $this->registration = $registration->load(['schedule', 'jamaah.documents', 'payments']);
    }
    
    public function collection()
    {
        return $this->registration->jamaah;
    }
    
    public function title(): string
    {
        return $this->registration->registration_number;
    }
    
    public function headings(): array
    {
        return [
            'No',
            'Nama Lengkap',
            'NIK',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Status Nikah',
            'Nama Ayah',
            'Pekerjaan',
            'Gol. Darah',
            'Alamat',
            'Provinsi',
            'Kota',
            'Kontak Darurat',
            'Hub. Darurat',
            'Telp Darurat',
            'Butuh Passport',
            'Status Dokumen',
        ];
    }
    
    public function map($jamaah): array
    {
        static $no = 0;
        $no++;
        
        $docCount = $jamaah->documents->count();
        $docStatus = $docCount >= 3 ? 'Lengkap' : "{$docCount}/3 Dokumen";
        
        return [
            $no,
            $jamaah->full_name,
            $jamaah->nik,
            $jamaah->birth_place,
            $jamaah->birth_date?->format('d/m/Y'),
            $jamaah->gender === 'L' ? 'Laki-laki' : 'Perempuan',
            $this->getMaritalStatus($jamaah->marital_status),
            $jamaah->father_name,
            $jamaah->occupation,
            $jamaah->blood_type ?? '-',
            $jamaah->address,
            $jamaah->province ?? '-',
            $jamaah->city ?? '-',
            $jamaah->emergency_name,
            $jamaah->emergency_relation,
            $jamaah->emergency_phone,
            $jamaah->need_passport ? 'Ya' : 'Tidak',
            $docStatus,
        ];
    }
    
    protected function getMaritalStatus($status)
    {
        return match($status) {
            'single' => 'Belum Menikah',
            'married' => 'Menikah',
            'divorced' => 'Cerai',
            'widowed' => 'Duda/Janda',
            default => $status
        };
    }
    
    public function styles(Worksheet $sheet)
    {
        // Add registration info at top
        $reg = $this->registration;
        
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}