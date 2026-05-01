<?php

namespace App\Services\Interfaces;

use App\Models\Tag;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TagServiceInterface
{
    /**
     * Summary of paginate
     *
     * @return LengthAwarePaginator
     */
    public function paginate(array $filters, int $perPage = 15);

    /**
     * Summary of create
     *
     * @return Tag
     */
    public function create(array $data);

    /**
     * Summary of findById
     *
     * @return Tag
     */
    public function findById(string $id);

    /**
     * Summary of update
     *
     * @return Tag
     */
    public function update(string $id, array $data);

    /**
     * Summary of delete
     *
     * @return Tag
     */
    public function delete(string $id);
}
