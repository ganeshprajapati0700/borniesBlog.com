<?php

namespace App\Services\Interfaces;

interface SubCategoryServiceInterface
{
    /**
     * Summary of paginateSubCategory
     * @param array $filters
     * @param int $perPage
     * @return array
     */
    public function paginateSubCategory(array $filters, int $perPage = 15);

    /**
     * Summary of create
     * @param array $data
     * @return void
     */
    public function create(array $data);

    /**
     * Summary of findById
     * @param string $id
     * @return void
     */
    public function findById(string $id);

    /**
     * Summary of update
     * @param string $id
     * @param array $data
     * @return void
     */
    public function update(string $id, array $data);

    /**
     * Summary of delete
     * @param string $id
     * @return void
     */
    public function delete(string $id);
}
