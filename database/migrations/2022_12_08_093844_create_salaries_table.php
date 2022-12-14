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
            $table->unsignedDecimal('base_salary')->default(0);
            $table->unsignedDecimal('motivations')->default(0);
            $table->unsignedDecimal('living_compensation')->default(0);
            $table->unsignedDecimal('additional')->default(0);
            $table->unsignedDecimal('food_allowance')->default(0);
            $table->unsignedDecimal('productivity_motivations')->default(0);
            $table->unsignedDecimal('nature_work')->default(0);
            $table->unsignedDecimal('variable_compensation')->default(0);
            $table->unsignedDecimal('fixed_compensation')->default(0);
            $table->unsignedDecimal('total_benefit')->default(0);
            $table->unsignedDecimal('absence')->default(0);
            $table->unsignedDecimal('absence_cut')->default(0);
            $table->unsignedDecimal('without_salary')->default(0);
            $table->unsignedDecimal('without_salary_cut')->default(0);
            $table->unsignedDecimal('late_cut')->default(0);
            $table->unsignedDecimal('mobile_bill')->default(0);
            $table->unsignedDecimal('punishments')->default(0);
            $table->unsignedDecimal('ordinary_advance')->default(0);
            $table->unsignedDecimal('jop')->default(0);
            $table->unsignedDecimal('social_insurance')->default(0);
            $table->unsignedDecimal('income_tax')->default(0);
            $table->unsignedDecimal('cooperat_box')->default(0);
            $table->unsignedDecimal('net_salary')->default(0);
            $table->unsignedDecimal('severance_pay')->default(0);

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
