<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('vehicle_id')->index();
            $table->string('police_id')->index();
            $table->unsignedBigInteger('agency_id')->index();
            $table->unsignedBigInteger('garage_id')->nullable()->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->boolean('approval')->default(false);
            $table->string('periode')->index();
            $table->string('reff_spk')->nullable()->index();
            $table->boolean('invoiced')->default(false);
            $table->string('reff_invoice')->nullable()->index();
            $table->date('date_invoice')->nullable()->index();
            $table->double('subtotal', 8, 2)->default(0);
            $table->double('tax', 8, 2)->default(0);
            $table->double('total', 8, 2)->default(0);
            $table->text('notes')->nullable();
            $table->enum('status', ['drafted', 'approved', 'delivered', 'invoiced'])->default('drafted')->index();
            $table->timestamps();

            $table->unique(['police_id', 'periode']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
