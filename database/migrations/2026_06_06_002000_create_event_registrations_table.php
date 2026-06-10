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
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
<<<<<<< HEAD
            $table->string('payment_status')->default('free');
            $table->string('transaction_id')->nullable();
            $table->decimal('amount_paid', 8, 2)->default(0.00);
=======

            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->string('transaction_id')->nullable();
            $table->decimal('amount_paid', 8, 2)->default(0.00);

            $table->string('payment_status')->default('free');

>>>>>>> 94b6e29863c11c24022e708633b5f8159caf365e
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_registrations');
    }
};
