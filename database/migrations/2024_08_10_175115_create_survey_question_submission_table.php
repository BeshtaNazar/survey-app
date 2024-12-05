<?php

use App\Models\SurveyQuestion;
use App\Models\SurveySubmission;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('survey_question_submission', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SurveyQuestion::class, "question_id");
            $table->foreignIdFor(SurveySubmission::class, "submission_id");
            $table->text("answer");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey_question_answers');
    }
};
