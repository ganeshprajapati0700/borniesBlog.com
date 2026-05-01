<?php

namespace App\Services;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Services\Interfaces\CategoryServiceInterface;
use Illuminate\Support\Str;

class CategoryService implements CategoryServiceInterface
{
    protected $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function paginateCategories(array $filters, int $perPage = 15)
    {
        return $this->categoryRepo->paginateCategories($filters, $perPage);
    }

    public function createCategory(array $data)
    {
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        return $this->categoryRepo->create($data);
    }

    public function getCategoryById(string $id)
    {
        return $this->categoryRepo->findById($id);
    }

    public function updateCategory(string $id, array $data)
    {
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        return $this->categoryRepo->update($id, $data);
    }

    public function deleteCategory(string $id)
    {
        return $this->categoryRepo->delete($id);
    }

    public function bulkDeleteCategories(array $ids)
    {
        return $this->categoryRepo->bulkDelete($ids);
    }

    public function bulkUpdateStatus(array $ids, int $status)
    {
        return $this->categoryRepo->bulkUpdateStatus($ids, $status);
    }
}
