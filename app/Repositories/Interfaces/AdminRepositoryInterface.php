<?php

namespace App\Repositories\Interfaces;

interface AdminRepositoryInterface
{
    public function create(array $data);

    public function findByEmail(string $email);
}
