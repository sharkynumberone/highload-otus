<?php

namespace App\Services\Generators;

use App\Services\Factories\UserGeneratorFactory;
use Illuminate\Support\Str;

class UserGenerator
{
    /**
     * @var UserGeneratorFactory
     */
    private $factory;

    /**
     * @param UserGeneratorFactory $factory
     */
    public function __construct(UserGeneratorFactory $factory)
    {
        $this->factory = $factory;
    }

    public function generate(string $first_name, string $last_name)
    {
        $raw_user_data = $this->generateUserData($first_name,$last_name);

        $user_service = $this->factory->createUserService();

        $register_user = $user_service->prepareRegisterData($raw_user_data);

        $user_repository = $this->factory->createUserRepository();
        $user_repository->create($register_user);
    }

    /**
     * @param string $first_name
     * @param string $last_name
     * @return array
     */
    private function generateUserData(string $first_name, string $last_name)
    {
        $email = Str::random(30).'@yandex.ru';
        $password = Str::random(20);

        $age = rand(10, 100);

        return [
            'email' => $email,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'password' => $password,
            'age' => $age,
        ];
    }

}
