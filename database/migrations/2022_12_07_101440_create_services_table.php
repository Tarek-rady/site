<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{

    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            $table->string('title_ar');
            $table->string('title_en');
            $table->text('desc_ar');
            $table->text('desc_en');
            $table->string('link');
            $table->string('img');
            $table->foreignId('category_id')->references('id')->on('categories')->cascadeOnDelete();

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('services');
    }
}
