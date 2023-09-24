<?php

use App\Models\Branch;
use App\Models\TypeOfCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('case_templates', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TypeOfCase::class);
            $table->foreignIdFor(Branch::class);
            $table->string('address');
            $table->json('plaintiffs');
            $table->string('civil_case_number');
            $table->json('defendants');
            $table->text('case_description');
            $table->json('latest_order');
            $table->text('note')->nullable();
            $table->string('prepared_by');
            $table->string('approved_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_templates');
    }
};
