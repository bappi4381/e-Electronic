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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); 
            $table->string('name')->nullable(); 
            $table->string('email')->nullable();
            $table->string('phone_number')->nullable(); 
            $table->text('address');
            $table->decimal('total_price', 10, 2)->default(0);
            $table->integer('total_quantity')->default(0);
            $table->string('status')->default('pending');
            $table->date('date')->default(now()); 
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
        Schema::dropIfExists('orders');
    }
};
