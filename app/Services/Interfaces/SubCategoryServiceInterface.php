<?php

namespace App\Services\Interfaces;

use App\Models\SubCategory;

interface SubCategoryServiceInterface
{
    /**
     * Summary of paginateSubCategory
     *
     * @return array
     */
    public function paginateSubCategory(array $filters, int $perPage = 15);

    /**
     * Summary of create
     *
     * @return void
     */
    public function create(array $data);

    /**
     * Summary of findById
     *
     * @return SubCategory
     */
    public function findById(string $id);

    /**
     * Summary of update
     *
     * @return void
     */
    public function update(string $id, array $data);

    /**
     * Summary of delete
     *
     * @return void
     */
    public function delete(string $id);
}
