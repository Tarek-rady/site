<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Notifications\AddTask;

class ProductsImport implements ToModel, WithHeadingRow,WithValidation
{
    public function model(array $row)
    {
            //   dd(Category::where('name_ar' , $row['category_id'])->pluck('id')[0] );
            $product = Product::create([
                'name_ar' => $row['name_ar'],
                'name_en' => $row['name_en'],
                'desc_ar' => $row['desc_ar'],
                'desc_en' => $row['desc_en'],
                'price' => $row['price'] ,
                'category_id' =>app()->getLocale() == "ar" ?  Category::where('name_ar' , $row['category_id'])->pluck('id')[0] : Category::where('name_en' , $row['category_id'])->pluck('id')[0] ,
                'img' => $row['img'] ,
                'created_at' => now()
            ]);


        return $product;

    }

    public function rules(): array
    {
        return [
            'name_ar' => 'required|max:255' ,
            'name_en' => 'required|max:255' ,
            'desc_ar' => 'required' ,
            'desc_en' => 'required' ,
            'price' => 'required|numeric' ,
            'category_id' => 'required'  ,
            'img' => 'required' ,

        ];
    }


}

