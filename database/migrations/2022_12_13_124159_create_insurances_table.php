<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->nullable()->unique()->constrained('users', 'job_id')->nullOnDelete();
            $table->string('social_insurance');
            $table->decimal('insurance_salary');
            $table->date('date_registration');
            $table->integer('social_insurance_number');
            $table->integer('remaining_advance');
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
        Schema::dropIfExists('insurances');
    }
}
