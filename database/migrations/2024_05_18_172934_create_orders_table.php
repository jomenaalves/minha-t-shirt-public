<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->integer('order_status');
            
            $table->string('client_document');
            $table->string('client_register')->nullable();
            $table->string('client_corporate_reason')->nullable();
            $table->string('client_state_registration')->nullable();
            $table->string('client_name');
            $table->string('client_email');
            $table->string('client_phone');

            $table->string('client_cep')->nullable();
            $table->string('client_address')->nullable();
            $table->string('client_number')->nullable();
            $table->string('client_complement')->nullable();
            $table->string('client_neighborhood')->nullable();
            $table->string('client_city')->nullable();
            $table->string('client_state')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
