<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uid')->default(0);
            $table->unsignedBigInteger('emp_id');
            $table->boolean('state')->default(0);
            $table->time('leave_time')->default(date("H:i:s"));
            $table->date('leave_date')->default(date("Y-m-d"));
            $table->boolean('status')->default(1);
            $table->boolean('type')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('emp_id')->references('id')->on('employees')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leaves', function (Blueprint $table) {
         $table->dropForeign(['emp_id']);
        });

        Schema::dropIfExists('leaves');
    }
}
