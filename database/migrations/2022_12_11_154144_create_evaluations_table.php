<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->nullable()->unique()->constrained('users', 'job_id')->nullOnDelete();
            $table->integer('latest_evaluation');
            $table->integer('manager_evaluation');
            $table->integer('hr_evaluation');
            $table->text('pros');
            $table->text('cons');
            $table->text('manager_recommendations');
            $table->text('hr_recommendations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluations');
    }
}
