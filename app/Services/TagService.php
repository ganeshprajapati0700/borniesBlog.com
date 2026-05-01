<?php

namespace App\Services;

use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Services\Interfaces\TagServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class TagService implements TagServiceInterface
{
    protected $tagRepo;

    /**
     * Summary of __construct
     *
     * @return LengthAwarePaginator
     */
    public function __construct(TagRepositoryInterface $tagRepository)
    {
        $this->tagRepo = $tagRepository;
    }

    public function paginate(array $filters, int $perPage = 15)
    {
        return $this->tagRepo->paginate($filters, $perPage);
    }

    public function create(array $data)
    {
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        return $this->tagRepo->create($data);
    }

    public function findById(string $id)
    {
        return $this->tagRepo->findById($id);
    }

    public function update(string $id, array $data)
    {
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name']);
        }

        return $this->tagRepo->update($id, $data);
    }

    public function delete(string $id)
    {
        return $this->tagRepo->delete($id);
    }
}
