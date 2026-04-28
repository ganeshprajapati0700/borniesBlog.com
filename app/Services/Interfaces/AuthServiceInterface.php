<?php

namespace App\Services\Interfaces;

interface AuthServiceInterface
{
    public function login(array $credentials, bool $remember);

    public function register(array $data);
}
