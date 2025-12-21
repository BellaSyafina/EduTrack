<?php

namespace App\Imports;

use App\Models\Kelas;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class KelasImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if (!isset($row['nama_kelas']) || $row['nama_kelas'] === null) {
            return null; // Skip rows without 'nama_kelas'
        }
        return new Kelas([
            'nama_kelas' => $row['nama_kelas']
        ]);
    }
}
