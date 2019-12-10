<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberActivityLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_activity_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action', 120);
            $table->text('user_agent')->nullable();
            $table->string('reference_url', 255)->nullable();
            $table->string('reference_name', 255)->nullable();
            $table->string('ip_address', 25)->nullable();
            $table->integer('member_id')->unsigned()->references('id')->on('members')->index();
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
        Schema::dropIfExists('member_activity_logs');
    }
}
