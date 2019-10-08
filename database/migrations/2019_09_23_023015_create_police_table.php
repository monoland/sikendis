<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoliceTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('police', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name')->index();
            $table->string('color')->nullable();
            $table->date('taxdue')->nullable();
            $table->double('taxsum', 8, 2)->default(0);
            $table->text('describe')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('police');
    }
}
