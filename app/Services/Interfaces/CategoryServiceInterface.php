<?php

namespace App\Services\Interfaces;

interface CategoryServiceInterface
{
    public function paginateCategories(array $filters, int $perPage = 15);

    public function createCategory(array $data);

    public function getCategoryById(string $id);

    public function updateCategory(string $id, array $data);

    public function deleteCategory(string $id);

    public function bulkDeleteCategories(array $ids);

    public function bulkUpdateStatus(array $ids, int $status);
}
