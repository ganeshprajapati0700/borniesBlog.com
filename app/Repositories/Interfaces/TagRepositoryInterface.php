<?php

namespace App\Repositories\Interfaces;

interface TagRepositoryInterface
{
    public function paginate(array $filters, int $perPage = 15);

    public function create(array $data);

    public function findById(string $id);

    public function update(string $id, array $data);

    public function delete(string $id);
}
