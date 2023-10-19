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
                //change column summary of case from string to text
                $table->text('summary_of_case')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('existing_case_data', function (Blueprint $table) {
            $table->string('summary_of_case')->change();
        });
    }
};
