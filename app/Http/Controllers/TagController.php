<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagFormRequest;
use App\Models\Tag;
use App\Services\Interfaces\TagServiceInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $tagservice;

    /**
     * Summary of __construct
     */
    public function __construct(TagServiceInterface $tagService)
    {
        $this->tagservice = $tagService;
    }

    /**
     * Summary of index
     *
     * @return View
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'status']);
        $data = $this->tagservice->paginate($filters, 15);

        return view('admin.tags.index', compact('data'));
    }

    /**
     * Summary of create
     *
     * @return View
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Summary of store
     *
     * @return RedirectResponse
     */
    public function store(TagFormRequest $request)
    {
        $data = $request->validated();
        $this->tagservice->create($data);

        return redirect()->route('tags.index')->with('success', 'Tag created successfully');
    }

    /**
     * Summary of edit
     *
     * @return View
     */
    public function edit(string $id)
    {
        $tag = $this->tagservice->findById($id);

        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Summary of update
     *
     * @return RedirectResponse
     */
    public function update(TagFormRequest $request, string $id)
    {
        $this->tagservice->update($id, $request->validated());

        return redirect()->route('tags.index')->with('success', 'Tag Updated Successfully.');
    }

    /**
     * Summary of destroy
     *
     * @return RedirectResponse
     */
    public function destroy(string $id)
    {
        $this->tagservice->delete($id);

        return redirect()->route('tags.index')->with('success', 'Tag Deleted Successfully.');
    }

    /** Toggle tag active/inactive status via AJAX. */
    public function toggleStatus(string $id)
    {
        $tag = Tag::findOrFail($id);
        $tag->status = $tag->status == '1' ? '0' : '1';
        $tag->save();

        return response()->json(['status' => (int) $tag->status]);
    }
}
