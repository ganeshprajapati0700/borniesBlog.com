<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostFormRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Services\Interfaces\PostServiceInterface;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use LogsActivity;

    protected $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

    /** Display a listing of all posts with filters. */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category', 'author', 'status']);
        $posts = $this->postService->paginate($filters, 15);
        $categories = Category::query()->where('status', 1)->get();
        $authors = User::query()->where('status', 1)->get();

        return view('admin.posts.index', compact('posts', 'categories', 'authors'));
    }

    /** Show the create form. */
    public function create()
    {
        $this->authorize('create', Post::class);

        $authors = User::query()->where('status', 1)->get();
        $categories = Category::query()->where('status', 1)->get();
        $tags = Tag::query()->where('status', 1)->get();

        return view('admin.posts.create', compact('authors', 'categories', 'tags'));
    }

    /** Store a new post. */
    public function store(PostFormRequest $request)
    {
        $this->authorize('create', Post::class);

        $post = $this->postService->create($request->validated());

        $this->logActivity('created', 'Post', $post->id, "Created post \"{$post->title}\"");

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    /** Show the edit form — author or admin only. */
    public function edit(string $id)
    {
        $post = $this->postService->findById($id);
        $this->authorize('update', $post);

        $categories = Category::query()->where('status', 1)->get();
        $authors = User::query()->where('status', 1)->get();
        $tags = Tag::query()->where('status', 1)->get();
        $assignedTagIds = $post->assignedTag->pluck('tag_id')->toArray();

        return view('admin.posts.edit', compact('post', 'categories', 'authors', 'tags', 'assignedTagIds'));
    }

    /** Update a post — author or admin only. */
    public function update(PostFormRequest $request, string $id)
    {
        $post = $this->postService->findById($id);
        $this->authorize('update', $post);

        $this->postService->update($id, $request->validated());

        $this->logActivity('updated', 'Post', $id, "Updated post \"{$post->title}\"");

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /** Delete a post — author or admin only. */
    public function destroy(string $id)
    {
        $post = $this->postService->findById($id);
        $this->authorize('delete', $post);

        $this->postService->delete($id);

        $this->logActivity('deleted', 'Post', $id, "Deleted post \"{$post->title}\"");

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    /** Toggle published/draft — author or admin only (AJAX). */
    public function toggleStatus(string $id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('toggleStatus', $post);

        $post->status = $post->status == 1 ? 0 : 1;
        $post->save();

        return response()->json(['status' => $post->status]);
    }

    /** Handle bulk actions (Delete, Publish, Draft) */
    public function bulkAction(Request $request)
    {
        $action = $request->action;
        $ids = $request->ids;

        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => 'No items selected.']);
        }

        switch ($action) {
            case 'delete':
                // Check authorization for each post
                foreach ($ids as $id) {
                    $post = $this->postService->findById($id);
                    $this->authorize('delete', $post);
                }
                $this->postService->bulkDelete($ids);
                $message = 'Selected posts deleted successfully.';
                break;
            case 'publish':
                foreach ($ids as $id) {
                    $post = $this->postService->findById($id);
                    $this->authorize('toggleStatus', $post);
                }
                $this->postService->bulkUpdateStatus($ids, 1);
                $message = 'Selected posts published.';
                break;
            case 'draft':
                foreach ($ids as $id) {
                    $post = $this->postService->findById($id);
                    $this->authorize('toggleStatus', $post);
                }
                $this->postService->bulkUpdateStatus($ids, 0);
                $message = 'Selected posts moved to draft.';
                break;
            default:
                return response()->json(['success' => false, 'message' => 'Invalid action.']);
        }

        return response()->json(['success' => true, 'message' => $message]);
    }

    /** Quick Update (AJAX) — edit fields like title directly from table */
    public function quickUpdate(Request $request, $id)
    {
        $post = $this->postService->findById($id);
        $this->authorize('update', $post);

        $data = $request->only(['title', 'category_id', 'status']);

        // Basic validation
        if (isset($data['title']) && empty($data['title'])) {
            return response()->json(['success' => false, 'message' => 'Title cannot be empty.']);
        }

        $this->postService->update($id, $data);

        return response()->json(['success' => true, 'message' => 'Post updated successfully.']);
    }
}
