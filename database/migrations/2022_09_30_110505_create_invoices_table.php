<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->string('product');         
            $table->bigInteger('section_id')->unsigned();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
            $table->decimal('amount_commission'); 
            $table->decimal('amount_collection');
            $table->decimal('discount');   
            $table->string('rate_vat');  
            $table->decimal('value_vat',8,2);  
            $table->decimal('total');  
            $table->text('note')->nullable(); 
            $table->date('payment_date')->nullable(); ;
            $table->string('status', 50);
            $table->integer('value_status');

            $table->softDeletes();  /////////////////////////
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
};
