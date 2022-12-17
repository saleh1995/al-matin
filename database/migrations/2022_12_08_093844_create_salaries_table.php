<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->nullable()->unique()->constrained('users', 'job_id')->nullOnDelete();
            $table->unsignedDecimal('base_salary')->nullable(0);
            $table->unsignedDecimal('motivations')->nullable(0);
            $table->unsignedDecimal('living_compensation')->nullable(0);
            $table->unsignedDecimal('additional')->nullable(0);
            $table->unsignedDecimal('food_allowance')->nullable(0);
            $table->unsignedDecimal('productivity_motivations')->nullable(0);
            $table->unsignedDecimal('nature_work')->nullable(0);
            $table->unsignedDecimal('variable_compensation')->nullable(0);
            $table->unsignedDecimal('fixed_compensation')->nullable(0);
            $table->unsignedDecimal('total_benefit')->nullable(0);
            $table->unsignedDecimal('absence')->nullable(0);
            $table->unsignedDecimal('absence_cut')->nullable(0);
            $table->unsignedDecimal('without_salary')->nullable(0);
            $table->unsignedDecimal('without_salary_cut')->nullable(0);
            $table->unsignedDecimal('late_cut')->nullable(0);
            $table->unsignedDecimal('mobile_bill')->nullable(0);
            $table->unsignedDecimal('punishments')->nullable(0);
            $table->unsignedDecimal('ordinary_advance')->nullable(0);
            $table->unsignedDecimal('jop')->nullable(0);
            $table->unsignedDecimal('social_insurance')->nullable(0);
            $table->unsignedDecimal('income_tax')->nullable(0);
            $table->unsignedDecimal('cooperat_box')->nullable(0);
            $table->unsignedDecimal('net_salary')->nullable(0);
            $table->unsignedDecimal('severance_pay')->nullable(0);

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
        Schema::dropIfExists('salaries');
    }
}
