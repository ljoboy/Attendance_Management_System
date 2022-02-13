<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('uid')->default(0);
            $table->unsignedBigInteger('emp_id');
            $table->boolean('state')->default(0);
            $table->time('attendance_time')->default(date("H:i:s"));;
            $table->date('attendance_date')->default(date("Y-m-d"));;
            $table->boolean('status')->default(1);
            $table->foreign('emp_id')->references('id')->on('employees')->onDelete('cascade');
            $table->boolean('type')->unsigned()->default(0);
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
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropForeign(['emp_id']);
           });


        Schema::dropIfExists('attendances');
    }
}
