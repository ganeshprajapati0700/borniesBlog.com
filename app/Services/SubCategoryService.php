<?php

namespace App\Services;

use App\Repositories\Interfaces\SubCategoryRepositoryInterface;
use App\Services\Interfaces\SubCategoryServiceInterface;
use Illuminate\Support\Str;

class SubCategoryService implements SubCategoryServiceInterface
{
    protected $subCatRepo;

    public function __construct(SubCategoryRepositoryInterface $subCatRepo)
    {
        $this->subCatRepo = $subCatRepo;
    }

    /**
     * Summary of paginateSubCategory
     *
     * @return array
     */
    public function paginateSubCategory(array $filters, int $perPage = 15)
    {
        return $this->subCatRepo->paginateSubCategories($filters, $perPage);
    }

    /**
     * Summary of create
     *
     * @return void
     */
    public function create(array $data)
    {
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        return $this->subCatRepo->create($data);
    }

    /**
     * Summary of findById
     *
     * @return void
     */
    public function findById(string $id)
    {
        return $this->subCatRepo->findById($id);
    }

    /**
     * Summary of update
     *
     * @return void
     */
    public function update(string $id, array $data)
    {
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        return $this->subCatRepo->update($id, $data);
    }

    /**
     * Summary of delete
     *
     * @return void
     */
    public function delete(string $id)
    {
        return $this->subCatRepo->delete($id);
    }
}
