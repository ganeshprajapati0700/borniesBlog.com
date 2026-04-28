<?php

namespace App\Repositories\Interfaces;

interface SubCategoryRepositoryInterface
{

    /**
     * paginate subcategories
     */
    public function paginateSubCategories(array $filters, int $perPage = 15);

    /**
     * create sub-categories
     */
    public function create(array $data);

    /**
     * find by id for edit
     */
    public function findById(string $id);

    /**
     * update sub-category
     */
    public function update(string $id, array $data);

    /**
     * destroy sub-category
     */
    public function delete(string $id);
}
