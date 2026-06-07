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
        Schema::create('donations', function (Blueprint $table) {
        $table->id();
        $table->string('donor_name');
        $table->decimal('donation_amount', 10, 2);
        
        $table->foreignId('donation_category_id')
              ->nullable()
              ->constrained('donations_categories') 
              ->onDelete('set null');
        
        $table->enum('payment_method', ['Cash', 'Bank', 'MFS']);
        $table->string('receiver_name');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
