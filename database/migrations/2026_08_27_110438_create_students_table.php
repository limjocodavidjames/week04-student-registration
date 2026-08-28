<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('mobile_number');
            $table->date('date_of_birth');
            $table->enum('gender', ['Male', 'Female', 'Non-binary', 'Prefer not to say']);
            $table->string('program');
            $table->enum('year_level', ['1st Year', '2nd Year', '3rd Year', '4th Year']);
            $table->text('address');
            $table->string('profile_picture');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('students');
    }
};