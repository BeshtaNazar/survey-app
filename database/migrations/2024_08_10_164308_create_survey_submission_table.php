<?php

use App\Models\User;
use App\Models\Survey;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('survey_submissions', function (Blueprint $table) {
            $table->id();
            $table->timestamp("start_date")->nullable();
            $table->timestamp("end_date")->nullable();
            $table->foreignIdFor(Survey::class, "survey_id");
            $table->foreignIdFor(User::class, "user_id");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_answers');
    }
};
