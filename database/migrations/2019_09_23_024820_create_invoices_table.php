<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('service_id')->unique();
            $table->string('refsinv')->unique();
            $table->date('duedate')->index();
            $table->string('periode')->index();
            $table->double('subtotal', 8, 2)->default(0);
            $table->double('disc', 8, 2)->default(0);
            $table->double('tax', 8, 2)->default(0);
            $table->double('total', 8, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('invoice_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('invoice_id')->index();
            $table->unsignedBigInteger('item_id')->index();
            $table->string('name')->nullable();
            $table->string('unit')->nullable();
            $table->unsignedSmallInteger('qty')->default(0);
            $table->double('price', 8, 2)->default(0);
            $table->double('amount', 8, 2)->default(0);
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('invoice_item');
    }
}
