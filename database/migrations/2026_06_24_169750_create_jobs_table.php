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
    Schema::create('job_lists', function (Blueprint $table) {
        $table->id();

        $table->foreignId('company_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->foreignId('category_id')
            ->constrained()
            ->cascadeOnDelete();

        $table->string('title')
            ->nllable();

        $table->text('description')
            ->nullable();

        $table->decimal('salary', 10, 2)
            ->nullable();

        $table->string('location');

        $table->enum('job_type', [
            'full_time',
            'part_time',
            'remote',
            'internship'
        ]);

        $table->enum('status', [
            'open',
            'closed'
        ])->default('open');

        $table->date('deadline')
            ->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_lists');
    }
};
