<?php

namespace App\Exports\Admin;

use App\Models\TacGia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TacGiaExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return TacGia::all();
    }
    public function headings(): array
    {
        return [
            'tentacgia',
            'slug',
            'mota',
            'khoa'
        ];
    }
    public function map($row): array
    {
        return [
            $row->tentacgia,
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
