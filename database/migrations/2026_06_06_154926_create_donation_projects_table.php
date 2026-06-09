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
        Schema::create('donation_projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('dascription')->nullable();
            $table->decimal('goal_amount',15,2);
            $table->decimal('raised_amount',15,2)->default(0.00);
            $table->string('status')->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donation_projects');
    }
};
