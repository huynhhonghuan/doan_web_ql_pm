<?php

namespace App\Exports\Admin;

use App\Models\TheLoai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TheLoaiExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TheLoai::all();
    }

    public function headings(): array
    {
        return [
            'tentheloai',
            'slug',
            'mota',
            'khoa'
        ];
    }
    public function map($row): array
    {
        return [
            $row->tentheloai,
            $row->slug,
            $row->mota,
            $row->khoa
        ];
    }
    public function startCell(): string
    {
        return 'A6';
    }
}
