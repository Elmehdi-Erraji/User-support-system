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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('priority', ['low', 'medium', 'high']); 
            // $table->enum('status', ['open', 'in_progress', 'on_hold', 'resolved', 'closed','wrong_category']); 
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('support_agent_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
