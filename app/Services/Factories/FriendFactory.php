<?php

namespace App\Services\Factories;

use App\Repositories\FriendRepository;
use App\Services\UserService;

class FriendFactory
{
    /**
     * @return UserService
     */
    public function createUserService(): UserService
    {
        return new UserService();
    }

    /**
     * @return FriendRepository
     */
    public function createFriendRepository(): FriendRepository
    {
        return new FriendRepository();
    }
}
