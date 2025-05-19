<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');   // Reference to users table
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');  // Reference to movies table
            $table->integer('quantity');                                         // Number of tickets bought
            $table->decimal('total_amount', 8, 2);                              // Total cost for tickets
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tickets');
    }


};
