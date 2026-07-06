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
        Schema::table('events', function (Blueprint $table) {
            //
            if (!Schema::hasColumn('events', 'amount')) {
                $table->decimal('amount', 10, 2)->default(0.00)->after('organized_by');
            }
            $table->enum('event_type', ['ticketed', 'fundraiser'])->default('ticketed')->after('amount');
            $table->decimal('raised_amount', 10, 2)->default(0.00)->after('event_type');
        });

        Schema::table('donations', function (Blueprint $table) {
            $table->foreignId('event_id')->nullable()->after('id')->constrained('events')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['event_type', 'raised_amount']);
        });

        Schema::table('donations', function (Blueprint $table) {
            $table->dropForeign(['event_id']);
            $table->dropColumn('event_id');
        });
    }
};
