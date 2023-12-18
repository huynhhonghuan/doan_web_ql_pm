<?php

namespace App\Imports\Admin;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TaiKhoanImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            
                'name'=> $row['name'],
                'username'=> $row['username'],
                'sdt'=> $row['sdt'],
                'email'=> $row['email'],
                'password'=> $row['password'],
                
        ]);
    }
    public function headingRow(): int
    {
        return 1;
    }
}
