<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject');
            $table->text('body');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        Schema::table('mails', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('mails');
    }
}
