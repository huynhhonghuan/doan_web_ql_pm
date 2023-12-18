<?php

namespace App\Imports\Congtacvientruyen;

use App\Models\Truyen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TruyenImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Truyen([
            'tentruyen' => $row['tentruyen'],
            'slug' =>$row['slug'],
            'mota' =>$row['mota'],
            'khoa' =>$row['khoa'],
            'nhomdich' => $row['nhomdich'],
            'hinhanh' => $row['hinhanh'],
            'theloai_id' => $row['theloai_id'],
            'tacgia_id' => $row['tacgia_id'],
            'quocgia_id' => $row['quocgia_id'],
            'user_id'=> $row['user_id'],
        ]);
    }
    public function headingRow() :int
    {
        return 6;
    }
}
