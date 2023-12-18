<?php

namespace App\Exports\Admin;

use App\Models\QuocGia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class QuocGiaExport implements FromCollection,  WithHeadings, WithCustomStartCell, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return QuocGia::all();
    }
    public function headings(): array
    {
        return [
            'tenquocgia',
            'slug',
            'mota',
            'khoa'
        ];
    }
    public function map($row): array
    {
        return [
            $row->tenquocgia,
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
