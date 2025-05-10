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
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // id (primary key)
            $table->unsignedBigInteger('user_id');
            $table->decimal('amount', 10, 2);
            $table->string('status',20)->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->timestamps(); // created_at and updated_at

            // Optional: foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->index('status'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
