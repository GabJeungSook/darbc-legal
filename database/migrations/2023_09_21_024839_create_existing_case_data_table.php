<?php

use App\Models\ExistingCase;
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
        Schema::create('existing_case_data', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ExistingCase::class);
            $table->dateTime('date_time');
            $table->string('subject_area');
            $table->string('summary_of_case');
            $table->string('petitioners_representative');
            $table->string('executed_by');
            $table->string('status');
            $table->text('attachment_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('existing_case_data');
    }
};
