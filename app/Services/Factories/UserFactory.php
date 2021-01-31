<?php

namespace App\Services\Factories;

use App\Repositories\UserRepository;
use App\Services\UserService;

class UserFactory
{
    /**
     * @return UserService
     */
    public function createUserService(): UserService
    {
        return new UserService();
    }

    /**
     * @return UserRepository
     */
    public function createUserRepository(): UserRepository
    {
        return new UserRepository();
    }
}
