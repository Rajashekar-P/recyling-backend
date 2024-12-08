<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('name'); // Column for user name
            $table->string('email')->unique(); // Unique email column
            $table->unsignedTinyInteger('rating'); // Rating column (e.g., 1-5)
            $table->text('message'); // Message column
            $table->timestamps(); // Created at and Updated at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
