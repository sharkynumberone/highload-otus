<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TABLE users
(
    id         int(11) not null auto_increment primary key,
    email      varchar(200)  not null unique,
    password   varchar(32)   not null,
    salt       varchar(32)   not null,
    first_name varchar(32)   not null,
    last_name  varchar(32)   not null,
    age        int(3) not null,
    gender     enum ('M','F'),
    interests  text,
    city       varchar(255)
);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP TABLE users;");
    }
}
