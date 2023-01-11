<?php

namespace App\Exports;

use App\Models\Product;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

use Maatwebsite\Excel\Concerns\WithMapping;

class ProductExport implements  FromCollection, WithHeadings,WithMapping
{

    public function map($product): array
    {
      return [
        $product->id ,
        $product->name_ar ,
        $product->name_en ,
        $product->desc_ar ,
        $product->desc_en ,
        $product->price ,
        $product->category->name ,
        $product->img ,
        $product->created_at,

      ];

    }

    public function headings():array{
        return[
            'id',
            'name_ar',
            'name_en',
            'desc_ar' ,
            'desc_en' ,
            'price' ,
            'category_id' ,
            'img' ,
            'created_at' ,

        ];
    }

    public function collection()
    {
        return Product::select('id' , 'name_ar' , 'name_en' , 'desc_ar' , 'desc_en' , 'price' , 'category_id' , 'img' , 'created_at')->get();

        // if (app()->getLocale() == 'ar'){
        //     return Product::select('id' , 'name_ar' , 'desc_ar' , 'price' , 'category_id' , 'created_at')->get();
        // }else{
        //     return Product::select( 'id' ,'name_en' , 'desc_en' , 'price' , 'category_id' ,'created_at')->get();
        // }
    }
}
