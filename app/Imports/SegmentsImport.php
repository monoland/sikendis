<?php

namespace App\Imports;

use App\Models\Segment;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SegmentsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Segment([
            'name' => $row['name'],
            'slug' => Str::slug($row['name']),
        ]);
    }
}
