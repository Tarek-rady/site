<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class CategoryImport implements ToCollection
{

    public function collection(Collection $rows)
    {

        // dd();
        $rows->shift();
        foreach ($rows as $row) {
            // dd($row[1]);
            $arr['name_ar'] = $row[1];
            $arr['name_en'] = $row[2];


            Category::create([
                'name_ar' => $arr['name_ar'],
                'name_en' => $arr['name_en'],
                'created_at'  => now() ,
            ]);
        }

    }

    // public function upsertColumns()
    // {
    //     return ['name_ar', 'name_en', 'created_at'];
    // }

    // public function rules(): array
    // {
    //     return [
    //         'name_ar' => 'required',
    //         'name_en' => 'required',

    //     ];
    // }
}
