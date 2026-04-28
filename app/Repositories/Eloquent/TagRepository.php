<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Illuminate\Container\Attributes\Tag;

class TagRepository implements TagRepositoryInterface
{
    public function paginateTags(array $filters, int $perPage = 15)
    {
        return Category::query()
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

    public function createTag(array $data)
    {
        return Tag::create($data);
    }

    public function findTagById(string $id)
    {
        return Tag::findOrFail($id);
    }

    public function update(string $id, array $data)
    {
        $category = Tag::findOrFail($id);
        $category->update($data);

        return $category;
    }

    public function delete(string $id)
    {
        $category = Tag::findOrFail($id);

        return $category->delete();
    }
}
