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
        Schema::table('masterlists', function (Blueprint $table) {
            $table->text('case_number')->nullable()->change();
            $table->text('case_title')->nullable()->change();
            $table->text('case_nature')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('masterlists', function (Blueprint $table) {
            $table->string('case_number')->nullable()->change();
            $table->string('case_title')->nullable()->change();
            $table->string('case_nature')->nullable()->change();
        });
    }
};
