<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnStatusBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->string('status', 60)->default('published')->change();
        });

        DB::table('blocks')->where('status', 'publish')->update(['status' => 'published']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blocks', function (Blueprint $table) {
            $table->string('status', 60)->default('publish')->change();
        });

        DB::table('blocks')->where('status', 'published')->update(['status' => 'publish']);
    }
}
