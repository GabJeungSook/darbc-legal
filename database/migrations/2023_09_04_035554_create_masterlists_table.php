<?php

use App\Models\Branch;
use App\Models\Status;
use App\Models\TypeOfCase;
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
        Schema::create('masterlists', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TypeOfCase::class);
            $table->foreignIdFor(Branch::class);
            $table->foreignIdFor(Status::class);
            $table->string('case_code');
            $table->string('case_number');
            $table->string('case_title');
            $table->string('case_nature');
            $table->string('legal_counsel');
            $table->string('opposing_counsel');
            $table->dateTime('date_filed');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('masterlists');
    }
};
