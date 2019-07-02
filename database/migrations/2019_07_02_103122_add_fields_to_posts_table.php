<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\PostStatusType;
use Illuminate\Support\Facades\DB;

class AddFieldsToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('posts')->truncate();
        Schema::table('posts', function (Blueprint $table) {
            $table->tinyInteger('status')->unsigned()->default(PostStatusType::Draft);
            $table->integer('category_id')->unsigned();
            $table->integer('user_id')->unsigned();
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
            $table->dropColumn(['status', 'category_id', 'user_id']);
        });
    }
}
