<?php

namespace App\Services\Entities;

class RegisterUser
{
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;
    /**
     * @var string
     */
    private $first_name;
    /**
     * @var string
     */
    private $last_name;
    /**
     * @var int
     */
    private $age;
    /**
     * @var string|null
     */
    private $gender;
    /**
     * @var string|null
     */
    private $interests;
    /**
     * @var string|null
     */
    private $city;
    /**
     * @var string
     */
    private $salt;

    /**
     * UserRegisterRequest constructor.
     * @param string $email
     * @param string $password
     * @param string $salt
     * @param string $first_name
     * @param string $last_name
     * @param int $age
     * @param string|null $gender
     * @param string|null $interests
     * @param string|null $city
     */
    public function __construct(string $email, string $password, string $salt, string $first_name, string $last_name, int $age, ?string $gender, ?string $interests, ?string $city)
    {
        $this->email = $email;
        $this->password = $password;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->age = $age;
        $this->gender = $gender;
        $this->interests = $interests;
        $this->city = $city;
        $this->salt = $salt;
    }

    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->salt;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->first_name;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->last_name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @return string|null
     */
    public function getInterests(): ?string
    {
        return $this->interests;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }
}
