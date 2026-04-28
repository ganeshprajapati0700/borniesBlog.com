<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface
{
    public function paginateCategories(array $filters, int $perPage = 15);

    public function create(array $data);

    public function findById(string $id);

    public function update(string $id, array $data);

    public function delete(string $id);
}
