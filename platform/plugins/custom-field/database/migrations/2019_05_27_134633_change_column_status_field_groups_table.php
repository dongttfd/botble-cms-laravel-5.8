<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnStatusFieldGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('field_groups', function (Blueprint $table) {
            $table->string('status', 60)->default('published')->change();
        });

        DB::table('field_groups')->where('status', 'publish')->update(['status' => 'published']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('field_groups', function (Blueprint $table) {
            $table->string('status', 60)->default('publish')->change();
        });

        DB::table('field_groups')->where('status', 'published')->update(['status' => 'publish']);
    }
}
