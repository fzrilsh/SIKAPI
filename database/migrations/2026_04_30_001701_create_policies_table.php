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
        Schema::create('policies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('ministry_id')->constrained('ministries')->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('summary');
            $table->string('document_url')->nullable();
            $table->enum('status', ['draft', 'public_evaluation', 'under_review', 'approved', 'needs_revision'])->default('draft');
            $table->date('deadline_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('policies');
    }
};
