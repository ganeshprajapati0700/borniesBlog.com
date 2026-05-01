<?php

namespace App\Repositories\Eloquent;

use App\Models\AssignedTag;
use App\Models\Post;
use App\Repositories\Interfaces\PostRepositoryInterface;
use Illuminate\Support\Str;

class PostRepository implements PostRepositoryInterface
{
    public function paginate(array $filters, int $perPage = 15)
    {
        return Post::query()->with(['author', 'category', 'subcategory', 'assignedTag'])
            ->when(isset($filters['search']) && $filters['search'] !== '', function ($query) use ($filters) {
                $search = $filters['search'];
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            })
            ->when(isset($filters['category']) && $filters['category'] !== '', function ($query) use ($filters) {
                $query->where('category_id', $filters['category']);
            })
            ->when(isset($filters['author']) && $filters['author'] !== '', function ($query) use ($filters) {
                $query->where('user_id', $filters['author']);
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
        $tags = $data['tags'] ?? [];
        unset($data['tags']);

        // Generate a unique slug
        $slug = Str::slug($data['title']);
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }
        $data['slug'] = $slug;

        $post = Post::create($data);

        // Attach tags to assigned_tags table
        if (! empty($tags)) {
            foreach ($tags as $tagId) {
                $post->assignedTag()->create(['tag_id' => $tagId]);
            }
        }

        return $post;
    }

    public function findById(string $id)
    {
        return Post::query()->with(['category', 'subcategory', 'author', 'assignedTag'])->findOrFail($id);
    }

    public function update(string $id, array $data)
    {
        $post = $this->findById($id);

        $tags = $data['tags'] ?? [];
        unset($data['tags']);

        // Check if title changed to update slug
        if (isset($data['title']) && $data['title'] !== $post->title) {
            $slug = Str::slug($data['title']);
            $originalSlug = $slug;
            $count = 1;
            while (Post::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = "{$originalSlug}-{$count}";
                $count++;
            }
            $data['slug'] = $slug;
        }

        $post->update($data);

        // Update tags
        $post->assignedTag()->delete(); // Clear existing tags
        if (! empty($tags)) {
            foreach ($tags as $tagId) {
                $post->assignedTag()->create(['tag_id' => $tagId]);
            }
        }

        return $post;
    }

    public function delete(string $id)
    {
        $post = Post::findOrFail($id);
        AssignedTag::where('post_id', $id)->delete();

        return $post->delete();
    }

    public function bulkDelete(array $ids)
    {
        AssignedTag::whereIn('post_id', $ids)->delete();

        return Post::whereIn('id', $ids)->delete();
    }

    public function bulkUpdateStatus(array $ids, int $status)
    {
        return Post::whereIn('id', $ids)->update(['status' => $status]);
    }
}
