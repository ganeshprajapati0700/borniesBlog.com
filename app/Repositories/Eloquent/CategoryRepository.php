<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function paginateCategories(array $filters, int $perPage = 15)
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

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function findById(string $id)
    {
        return Category::findOrFail($id);
    }

    public function update(string $id, array $data)
    {
        $category = Category::findOrFail($id);
        $category->update($data);

        return $category;
    }

    public function delete(string $id)
    {
        $category = Category::findOrFail($id);

        return $category->delete();
    }
}
