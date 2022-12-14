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
            $table->tinyInteger('id_photo')->default(0);
            $table->tinyInteger('residence_document')->default(0);
            $table->tinyInteger('no_conviction')->default(0);
            $table->tinyInteger('individual_civil_record')->default(0);
            $table->tinyInteger('personal_photos')->default(0);
            $table->tinyInteger('certificate_copy')->default(0);
            $table->tinyInteger('medical_report')->default(0);
            $table->tinyInteger('military_notebook')->default(0);

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
