<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->nullable()->constrained('users', 'job_id')->nullOnDelete();
            $table->foreignId('head_id')->nullable()->constrained('users', 'job_id')->nullOnDelete();
            $table->date('start_date');
            $table->date('end_date');
            $table->text('reasons')->nullable();
            $table->integer('request_status'); //0 = no request yet / 1 = waiting for head accept / 2 = waiting for hr manager accept / 3 = vacation accepted / 4 = vacation not accepted
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
        Schema::dropIfExists('vacations');
    }
}
