<?php

namespace App\Exports\Admin;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TaiKhoanExport implements FromCollection, WithHeadings, WithCustomStartCell, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }
    public function headings(): array
    {
        return [
        'name',
        'username',
        'sdt',
        'email',
        'password',
        ];
    }
    public function map($row): array
    {
        return [
            $row->name,
            $row->username,
            $row->sdt,
            $row->email,
            $row->password
        ];
        
    }
    public function startCell(): string
    {
        return 'A1';
    }
}
