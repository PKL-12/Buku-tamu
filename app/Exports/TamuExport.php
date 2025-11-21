<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TamuExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $data;
    protected $count = 0;

    public function __construct(Collection $data)
    {
        $this->data = $data;
        $this->count = $data->count();
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Nama',
            'No Telp',
            'Tujuan',
            'Sub Tujuan'
        ];
    }

    public function map($tamu): array
    {
        static $row = 0;
        $row++;

        return [
            $row,
            $tamu->tanggal_berkunjung,
            $tamu->nama,
            $tamu->no_telp,
            $tamu->tujuan,
            $tamu->sub_tujuan
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Header bold
        $sheet->getStyle('A1:F1')->getFont()->setBold(true);

        // Beri border ke semua baris
        $sheet->getStyle('A1:F' . ($this->count + 1))
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [];
    }
}
