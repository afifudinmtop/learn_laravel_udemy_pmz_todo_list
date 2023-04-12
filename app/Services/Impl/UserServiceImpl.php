<?php

namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService{
    private array $users = [
        "apip" => "udin"
    ];

    public function login($user, $password)
    {
        if (!isset($this->users[$user])) {
            return false;
        }

        $correctPassword = $this->users[$user];
        return $password == $correctPassword;
    }
}