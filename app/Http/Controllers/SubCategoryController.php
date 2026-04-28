<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryFormRequest;
use App\Models\Category;
use App\Services\Interfaces\SubCategoryServiceInterface;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $subcategoryservice;

    public function __construct(SubCategoryServiceInterface $subcategoryservice)
    {
        $this->subcategoryservice = $subcategoryservice;
    }
    /**
     * Summary of index
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'categoryId', 'status']);
        $data = $this->subcategoryservice->paginateSubCategory($filters, 15);

        return view('admin.subCategory.index', [
            'subCategories' => $data['subCategories'],
            'categories' => $data['categories'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.subCategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubCategoryFormRequest $request)
    {
        $data = $request->validated();
        $this->subcategoryservice->create($data);

        return redirect()->route('subcategories.index')->with('success', 'Sub-category created successfully.');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $subCategory = $this->subcategoryservice->findById($id);
        $categories = Category::where('status', 1)->get();
        return view('admin.subCategory.edit', compact('subCategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
