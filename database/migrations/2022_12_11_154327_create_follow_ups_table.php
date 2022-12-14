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
            $table->tinyInteger('id_photo');
            $table->tinyInteger('residence_document');
            $table->tinyInteger('no_conviction');
            $table->tinyInteger('individual_civil_record');
            $table->tinyInteger('personal_photos');
            $table->tinyInteger('certificate_copy');
            $table->tinyInteger('medical_report');
            $table->tinyInteger('military_notebook');

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
