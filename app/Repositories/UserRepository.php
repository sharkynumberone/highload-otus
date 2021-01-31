<?php

namespace App\Repositories;

use App\Services\Entities\RegisterUser;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    /**
     * @param RegisterUser $register_user
     */
    public function create(RegisterUser $register_user)
    {
        DB::insert("insert into users (
        email,
        password,
        salt,
        first_name,
        last_name,
        age,
        gender,
        interests,
        city
        )
values (?,?,?,?,?,?,?,?,?);

",[$register_user->getEmail(),
            $register_user->getPassword(),
            $register_user->getSalt(),
            $register_user->getFirstName(),
            $register_user->getLastName(),
            $register_user->getAge(),
            $register_user->getGender(),
            $register_user->getInterests(),
            $register_user->getCity()]);
    }

    /**
     * @param string $email
     * @return array
     */
    public function findByEmail(string $email)
    {
        return DB::select("select * from users where email='$email' limit 1");
    }

    /**
     * @param int $user_id
     * @return array
     */
    public function findByUserId(int $user_id)
    {
        return DB::select("select * from users where id='$user_id'");
    }

    /**
     * @param string $email
     * @param string $password
     * @return array
     */
    public function findByEmailAndPassword(string $email, string $password)
    {
        return DB::select("select * from users where email='$email' and password='$password'");
    }

    /**
     * @param int $user_id
     * @return array
     */
    public function getAllWithoutCurrentUser(int $user_id)
    {
        return DB::select("select users.*, friends.friend_id as friend from users left join friends on friends.friend_id = users.id  where users.id <> '$user_id'");
    }

    public function findByFirstNameAndLastName(string $first_name, string $last_name)
    {
        return DB::select("select users.* from users where first_name like '$first_name' and last_name like '$last_name' order by id desc");
    }
}
