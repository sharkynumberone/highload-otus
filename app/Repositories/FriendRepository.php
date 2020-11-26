<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class FriendRepository
{
    public function addToList(int $user_id, int $friend_id)
    {
        DB::insert("insert into friends (
        user_id,
        friend_id
        )
values (?,?);

",[$user_id, $friend_id]);
    }

    /**
     * @param int $user_id
     * @param int $friend_id
     * @return array
     */
    public function isAddedToList(int $user_id, int $friend_id)
    {
        return DB::select("select * from friends where user_id='$user_id' && friend_id='$friend_id'");
    }

    /**
     * @param int $user_id
     * @param int $friend_id
     * @return void
     */
    public function removeFromList(int $user_id, int $friend_id)
    {
        DB::delete("delete from friends where user_id='$user_id' && friend_id='$friend_id'");
    }

    public function getAll(int $user_id)
    {
        return DB::select("select users.* from friends left join users on users.id = friends.friend_id where friends.user_id='$user_id'");
    }
}
