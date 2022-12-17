<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->nullable()->unique()->constrained('users', 'job_id')->nullOnDelete();
            $table->tinyInteger('id_photo')->nullable()->default(0);
            $table->tinyInteger('residence_document')->nullable()->default(0);
            $table->tinyInteger('no_conviction')->nullable()->default(0);
            $table->tinyInteger('individual_civil_record')->nullable()->default(0);
            $table->tinyInteger('personal_photos')->nullable()->default(0);
            $table->tinyInteger('certificate_copy')->nullable()->default(0);
            $table->tinyInteger('medical_report')->nullable()->default(0);
            $table->tinyInteger('military_notebook')->nullable()->default(0);

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
        Schema::dropIfExists('follow_ups');
    }
}
