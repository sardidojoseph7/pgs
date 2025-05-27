<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
        $table->uuid('id')->primary(); // this creates an auto-incrementing primary key
        $table->string('first_name');
        $table->string('middle_name')->nullable();
        $table->string('last_name');
        $table->string('address');
        $table->string('department_name');
        $table->decimal('salary', 10, 2);
        $table->string('bank_account_number');
        $table->string('phone_number');
        $table->timestamps();
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};