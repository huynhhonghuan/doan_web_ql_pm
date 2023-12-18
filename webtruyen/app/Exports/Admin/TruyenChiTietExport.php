<?php

namespace App\Exports\Admin;

use App\Models\TruyenChiTiet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TruyenChiTietExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TruyenChiTiet::all();
    }
    public function headings(): array
    {
        return [
            'truyen_id',
            'hinhanh',
            'chuong',
        ];
    }
    public function map($row): array
    {
        return [
            $row->truyen_id,
            $row->hinhanh,
            $row->chuong
        ];
    }
    public function startCell(): string
    {
        return 'A1';
    }
}
