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
       //add column foreign key on existing_cases_data table
        Schema::table('existing_cases', function (Blueprint $table) {
            $table->foreign('masterlist_id')
                ->references('id')
                ->on('masterlists')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('existing_cases', function (Blueprint $table) {
            $table->dropForeign(['masterlist_id']);
            $table->dropColumn('masterlist_id');
        });
    }
};
