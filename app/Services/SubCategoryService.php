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
     * @param array $filters
     * @param int $perPage
     * @return array
     */
    public function paginateSubCategory(array $filters, int $perPage = 15)
    {
        return $this->subCatRepo->paginateSubCategories($filters, $perPage);
    }

    /**
     * Summary of create
     * @param array $data
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
     * @param string $id
     * @return void
     */
    public function findById(string $id)
    {
        return $this->subCatRepo->findById($id);
    }

    /**
     * Summary of update
     * @param string $id
     * @param array $data
     * @return void
     */
    public function update(string $id, array $data)
    {
        if (empty($data['slug'])) {
            $data['slug'] == Str::slug($data['name']);
        }

        return $this->subCatRepo->update($id, $data);
    }

    /**
     * Summary of delete
     * @param string $id
     * @return void
     */
    public function delete(string $id)
    {
        return $this->delete($id);
    }
}
