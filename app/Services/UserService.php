<?php

namespace App\Services;

use App\Services\Entities\RegisterUser;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Session\SessionManager;
use Illuminate\Session\Store;

class UserService
{
    /**
     * @param array $valid_data
     * @return RegisterUser
     */
    public function prepareRegisterData(array $valid_data)
    {
        $salt = $this->salt();

        $password = md5(md5($valid_data['password']) . $salt);

        return new RegisterUser(
            $valid_data['email'],
            $password,
            $salt,
            $valid_data['first_name'],
            $valid_data['last_name'],
            $valid_data['age'],
            $valid_data['gender'] ?? null,
            $valid_data['interests'] ?? null,
            $valid_data['city'] ?? null
        );
    }

    private function salt()
    {
        return substr(md5(uniqid()), -8);
    }

    /**
     * @return Application|SessionManager|Store|mixed
     */
    public function getCurrentUserId()
    {
        return session('auth_user_id');
    }

    public function authorize(int $user_id)
    {
        session(['auth_user_id' => $user_id]);
    }

    public function logout()
    {
        session()->forget('auth_user_id');
    }

    /**
     * @param string $password
     * @param string $db_password
     * @param string $db_salt
     * @return bool
     */
    public function checkAuthorize(string $password, string $db_password, string $db_salt)
    {
        return md5(md5($password).$db_salt) === $db_password;
    }
}
