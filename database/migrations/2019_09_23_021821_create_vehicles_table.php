<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->index();
            $table->unsignedSmallInteger('year')->default(0);
            $table->string('frame_numb')->index();
            $table->string('machine_numb')->index();
            $table->string('refs_numb')->nullable();
            $table->unsignedBigInteger('brand_id')->index();
            $table->unsignedBigInteger('type_id')->index();
            $table->string('police_id')->index();
            $table->unsignedBigInteger('agency_id')->nullable()->index();
            $table->enum('condition', ['B', 'KB', 'RB'])->default('B');
            $table->double('recaps', 8, 2)->default(0);
            $table->timestamps();

            $table->unique(['frame_numb', 'machine_numb']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
