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
           // $table->unsignedBigInteger('existing_cases_id');
            $table->foreign('existing_case_id')
                ->references('id')
                ->on('existing_cases')
                ->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('existing_case_data', function (Blueprint $table) {
            $table->dropForeign(['existing_case_id']);
            $table->dropColumn('existing_case_id');
        });
    }
};
