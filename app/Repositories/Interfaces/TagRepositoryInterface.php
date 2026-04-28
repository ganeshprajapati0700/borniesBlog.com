<?php

namespace App\Repositories\Interfaces;

interface TagRepositoryInterface
{
    public function paginateTags(array $filters, int $perPage = 15);

    public function createTag(array $data);

    public function findTagById(string $id);

    public function update(string $id, array $data);

    public function delete(string $id);
}
