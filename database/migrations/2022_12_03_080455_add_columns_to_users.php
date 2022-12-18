<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('email');
            $table->dropColumn('email_verified_at');


            $table->bigInteger('job_id')->unique();
            $table->string('address')->nullable();
            $table->string('place_of_job')->nullable();
            $table->string('phone')->nullable();
            $table->char('internal_phone', 8)->nullable();
            $table->integer('vacation_status')->nullable();
            $table->integer('role')->default(0);
            $table->tinyInteger('change_password')->default(1);



            // $table->bigInteger('manager_id')->nullable();

            // $table->unsignedBigInteger('manager_id')->nullable();
            // $table->foreign('manager_id')->references('job_id')->on('users');

            $table->foreignId('manager_id')->nullable()->constrained('users', 'job_id')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('job_id');
            $table->dropColumn('address');
            $table->dropColumn('place_of_job');
            $table->dropColumn('phone');
            $table->dropColumn('internal_phone');
            $table->dropColumn('vacation_status');
            $table->dropColumn('role');
            $table->dropColumn('change_password');

            // $table->dropColumn('manager_id');
            $table->dropForeign(['manager_id']);

            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
        });
    }
}
