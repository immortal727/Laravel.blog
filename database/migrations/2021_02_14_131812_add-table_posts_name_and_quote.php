<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTablePostsNameAndQuote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->text('quote')->after('description');
            $table->string('title')->after('name')->change();
            $table->text('description')->nullable()->after('title')->change();
            $table->string('slug')->after('name')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('quote');
            $table->string('title')->change();
            $table->text('description')->change();
            $table->string('slug')->change();
        });
    }
}
