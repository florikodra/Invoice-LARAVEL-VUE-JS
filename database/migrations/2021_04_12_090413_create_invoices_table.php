<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::dropIfExists('migrations');

        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('greeting')->nullable();
            $table->text('company')->nullable();
            $table->string('reference_person')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('currency')->nullable();
            $table->decimal('tax', 10, 2)->nullable();
            $table->decimal('subtotal', 10, 2)->nullable();
            $table->decimal('total', 10, 2)->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
        
    }
}