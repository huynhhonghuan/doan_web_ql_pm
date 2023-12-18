<?php

namespace App\Exports\Admin;

use App\Models\Truyen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TruyenExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Truyen::all();
    }
    public function headings(): array
    {
        return [
            'tentruyen',
            'slug',
            'mota',
            'khoa',
            'nhomdich',
            'hinhanh',
            'theloai_id',
            'tacgia_id',
            'quocgia_id',
            'user_id'
        ];
    }
    public function map($row): array
    {
        return [
            $row->tentruyen,
            $row->slug,
            $row->mota,
            $row->khoa,
            $row->nhomdich,
            $row->hinhanh,
            $row->theloai_id,
            $row->tacgia_id,
            $row->quocgia_id,
            $row->user_id
        ];
    }
    public function startCell(): string
    {
        return 'A1';
    }
}
