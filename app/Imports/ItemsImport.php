<?php

namespace App\Imports;

use App\Models\Item;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Item([
            'name' => $row['name'],
            'slug' => Str::slug($row['name']),
            'unit' => $row['unit'],
            'maxi' => $row['maxi'],
            'segment_id' => $row['segment_id'],
        ]);
    }
}
