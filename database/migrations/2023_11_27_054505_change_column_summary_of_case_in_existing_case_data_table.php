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
        Schema::table('existing_case_data', function (Blueprint $table) {
            $table->text('subject_area')->nullable()->change();
            $table->text('summary_of_case')->nullable()->change();
            $table->text('petitioners_representative')->nullable()->change();
            $table->text('executed_by')->nullable()->change();
            $table->text('status')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('existing_case_data', function (Blueprint $table) {
            $table->string('subject_area')->nullable()->change();
            $table->string('summary_of_case')->nullable()->change();
            $table->string('petitioners_representative')->nullable()->change();
            $table->string('executed_by')->nullable()->change();
            $table->string('status')->nullable()->change();
        });
    }
};
