<?php

namespace App\Imports;

use App\Models\Agency;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AgenciesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Agency([
            'name' => $row['name'],
            'slug' => Str::slug($row['name']),
            'root' => (bool) $row['root'],
        ]);
    }
}
