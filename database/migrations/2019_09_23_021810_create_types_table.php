<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index();
            $table->string('slug')->index();
            $table->unsignedSmallInteger('year')->default(0);
            $table->double('maxi', 8, 2)->default(0);
            $table->double('warn', 8, 2)->default(0);
            $table->unsignedBigInteger('brand_id')->index();
            $table->timestamps();

            $table->unique(['slug', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
