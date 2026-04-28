<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Models\SubCategory;
use App\Repositories\Interfaces\SubCategoryRepositoryInterface;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{
    /**
     * Summary of paginateSubCategories
     * @param array $filters
     * @param int $perPage
     * @return array
     */
    public function paginateSubCategories(array $filters, int $perPage = 15)
    {
        $subCategories = SubCategory::query()
            ->with('category')
            ->when(!empty($filters['search']), function ($query) use ($filters) {
                $search = $filters['search'];
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('slug', 'like', "%{$search}%");
                });
            })
            ->when(isset($filters['status']) && $filters['status'] !== '', function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->when(isset($filters['categoryId']) && $filters['categoryId'] !== '', function ($query) use ($filters) {
                $query->where('category_id', $filters['categoryId']);
            })
            ->orderBy('id', 'desc')
            ->paginate($perPage)
            ->withQueryString();

        $categories = Category::where('status', 1)->get();

        return [
            'subCategories' => $subCategories,
            'categories' => $categories,
        ];
    }

    /**
     * Summary of createSubCategories
     * @param array $data
     * @return 
     */

    public function create(array $data)
    {
        return SubCategory::create($data);
    }

    /**
     * Summary of findById
     * @param string $id
     * @return 
     */
    public function findById(string $id)
    {
        return SubCategory::findOrFail($id);
    }
    /**
     * Summary of updateSubCategories
     * @param string $id
     * @param array $data
     * @return 
     */
    public function update(string $id, array $data)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->update($data);

        return $subCategory;
    }

    /**
     * Summary of createSubCategories
     * @param string $id
     * @return 
     */
    public function delete(string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        return $subCategory->delete();
    }
}
