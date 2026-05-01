<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryFormRequest;
use App\Models\Category;
use App\Services\Interfaces\CategoryServiceInterface;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use LogsActivity;

    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'status']);
        $categories = $this->categoryService->paginateCategories($filters, 15);

        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryFormRequest $request)
    {
        $category = $this->categoryService->createCategory($request->validated());

        $this->logActivity('created', 'Category', $category->id, "Created category \"{$category->name}\"");

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->categoryService->getCategoryById($id);

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryFormRequest $request, string $id)
    {
        $category = $this->categoryService->getCategoryById($id);
        $this->categoryService->updateCategory($category->id, $request->validated());

        $this->logActivity('updated', 'Category', $category->id, "Updated category \"{$category->name}\"");

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = $this->categoryService->getCategoryById($id);
        $this->categoryService->deleteCategory($category->id);

        $this->logActivity('deleted', 'Category', $category->id, "Deleted category \"{$category->name}\"");

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }

    /** Toggle category status via AJAX. */
    public function toggleStatus(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        if ($request->user() && $request->user()->is_admin) {
            $category->status = $category->status == 1 ? 0 : 1;
            $category->save();

            return response()->json(['status' => $category->status]);
        }

        return response()->json(['error' => 'Unauthorized'], 403);
    }

    /** Handle bulk actions for categories */
    public function bulkAction(Request $request)
    {
        if (! $request->user() || ! $request->user()->is_admin) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $action = $request->action;
        $ids = $request->ids;

        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => 'No items selected.']);
        }

        switch ($action) {
            case 'delete':
                $this->categoryService->bulkDeleteCategories($ids);
                $message = 'Selected categories deleted.';
                break;
            case 'publish':
                $this->categoryService->bulkUpdateStatus($ids, 1);
                $message = 'Selected categories activated.';
                break;
            case 'draft':
                $this->categoryService->bulkUpdateStatus($ids, 0);
                $message = 'Selected categories deactivated.';
                break;
            default:
                return response()->json(['success' => false, 'message' => 'Invalid action.']);
        }

        return response()->json(['success' => true, 'message' => $message]);
    }

    /** Quick Update (AJAX) for categories */
    public function quickUpdate(Request $request, $id)
    {
        if (! $request->user()->is_admin) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $data = $request->only(['name', 'status']);

        if (isset($data['name']) && empty($data['name'])) {
            return response()->json(['success' => false, 'message' => 'Name cannot be empty.']);
        }

        $this->categoryService->updateCategory($id, $data);

        return response()->json(['success' => true, 'message' => 'Category updated.']);
    }
}
