<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['student', 'librarian'])->default('student');
            $table->rememberToken();
            $table->timestamps();
        });

        // Insert the default librarian account
        DB::table('users')->insert([
            'name' => 'Librarian',
            'email' => 'librarian@example.com',
            'password' => Hash::make('password'), // Use a secure password
            'role' => 'librarian',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
