<?php

namespace App\Imports\Admin;

use App\Models\TruyenChiTiet;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TruyenChiTietImport implements ToModel, WithHeadingRow
{
    /**
<<<<<<< HEAD
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
=======
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
>>>>>>> 7aab9fa8bd82775ec2d7512aded858bcc0985a06
    public function model(array $row)
    {
        return new TruyenChiTiet([
            'truyen_id' => $row['truyen_id'],
            'hinhanh' => $row['hinhanh'],
            'chuong' => $row['chuong'],
        ]);
    }
<<<<<<< HEAD
    public function headingRow() :int
=======
    public function headingRow(): int
>>>>>>> 7aab9fa8bd82775ec2d7512aded858bcc0985a06
    {
        return 1;
    }
}
