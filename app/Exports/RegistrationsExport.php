<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RegistrationsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    protected $filters;
    
    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }
    
    public function collection()
    {
        $query = Registration::with(['schedule', 'jamaah', 'payments']);
        
        // Apply filters
        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }
        
        if (!empty($this->filters['schedule_id'])) {
            $query->where('schedule_id', $this->filters['schedule_id']);
        }
        
        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('registration_number', 'like', "%{$search}%")
                  ->orWhere('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
        
        return $query->latest()->get();
    }
    
    public function headings(): array
    {
        return [
            'No. Registrasi',
            'Nama Pemesan',
            'Email',
            'No. HP',
            'Paket',
            'Tgl Berangkat',
            'Jumlah Jamaah',
            'Total Harga',
            'DP',
            'Status Pembayaran',
            'Status',
            'Progress (%)',
            'Tanggal Daftar',
        ];
    }
    
    public function map($reg): array
    {
        $dpPayment = $reg->payments->where('payment_type', 'dp')->first();
        
        return [
            $reg->registration_number,
            $reg->full_name,
            $reg->email,
            $reg->phone,
            $reg->schedule->package_name ?? '-',
            $reg->schedule?->departure_date?->format('d/m/Y') ?? '-',
            $reg->num_people,
            $reg->total_price,
            $reg->dp_amount,
            $dpPayment ? ucfirst($dpPayment->status) : 'Belum Bayar',
            ucfirst($reg->status),
            $reg->completion_percentage . '%',
            $reg->created_at->format('d/m/Y H:i'),
        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            // Header row bold
            1 => ['font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']]],
        ];
    }
}