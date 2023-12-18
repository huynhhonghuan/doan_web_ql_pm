<?php

namespace App\Imports\Admin;

use App\Models\TheLoai;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TheLoaiImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new TheLoai([
            'tentheloai' => $row['tentheloai'],
            'slug' => $row['slug'],
            'mota' => $row['mota'],
            'khoa' => $row['khoa']
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
