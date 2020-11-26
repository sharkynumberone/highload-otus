<?php

use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TABLE friends
(
    user_id    int(11) not null,
    friend_id  int(11) not null,
    CONSTRAINT friend_pair unique (user_id,friend_id)
);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TABLE friends;");
    }
}
