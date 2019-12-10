<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReCreateCustomFieldTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->text('rules')->nullable();
            $table->integer('order')->default(0);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->string('status', 60)->default('publish');
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('field_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('field_group_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('order')->default(0)->nullable();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->string('type', 100);
            $table->text('instructions')->nullable();
            $table->text('options')->nullable();

            $table->foreign('field_group_id')->references('id')->on('field_groups')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('field_items')->onDelete('cascade');
        });

        Schema::create('custom_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('use_for', 255);
            $table->integer('use_for_id')->unsigned();
            $table->integer('field_item_id')->unsigned();
            $table->string('type', 255);
            $table->string('slug', 255);
            $table->text('value')->nullable();

            $table->foreign('field_item_id')->references('id')->on('field_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('custom_fields');
        Schema::dropIfExists('field_items');
        Schema::dropIfExists('field_groups');
    }
}
