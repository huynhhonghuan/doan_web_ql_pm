<?php

namespace App\Imports\Admin;

use App\Models\TruyenChiTiet;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TruyenChiTietImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new TruyenChiTiet([
            'truyen_id' => $row['truyen_id'],
            'hinhanh' => $row['hinhanh'],
            'chuong' => $row['chuong'],
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
