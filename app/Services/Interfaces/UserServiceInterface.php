<?php

namespace App\Services\Interfaces;

interface UserServiceInterface
{
    public function paginate(array $filters, $perPage = 15);

    public function create(array $data);

    public function findById(string $id);

    public function update(string $id, array $data);

    public function delete(string $id);
}
