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
        Schema::create('payslip_statuses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('payslip_id')->constrained('payslips')->onDelete('cascade'); // foreign key constraint here only
            $table->string('label'); // e.g. Pending, Released, Cancelled
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payslip_statuses');
    }
};
