<?php

namespace App\Repositories\Eloquent;

use App\Models\Tag;
use App\Repositories\Interfaces\TagRepositoryInterface;

class TagRepository implements TagRepositoryInterface
{
    public function paginate(array $filters, int $perPage = 15)
    {
        return Tag::query()
            ->when(isset($filters['search']) && $filters['search'] !== '', function ($query) use ($filters) {
                $search = $filters['search'];
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%");
            })
            ->when(isset($filters['status']) && $filters['status'] !== '', function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    public function create(array $data)
    {
        return Tag::create($data);
    }

    public function findById(string $id)
    {
        return Tag::findOrFail($id);
    }

    public function update(string $id, array $data)
    {
        $tag = Tag::findOrFail($id);
        $tag->update($data);

        return $tag;
    }

    public function delete(string $id)
    {
        $tag = Tag::findOrFail($id);

        return $tag->delete();
    }
}
