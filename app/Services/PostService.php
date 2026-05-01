<?php

namespace App\Services;

use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Services\Interfaces\PostServiceInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class PostService implements PostServiceInterface
{
    protected $postRepo;

    /**
     * Create a new class instance.
     */
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepo = $postRepository;
    }

    public function paginate(array $filters, int $perPage = 15)
    {
        return $this->postRepo->paginate($filters, $perPage);
    }

    public function create(array $data)
    {
        if (isset($data['image_path']) && $data['image_path'] instanceof UploadedFile) {
            $image = $data['image_path'];
            $filename = time().'_'.uniqid().'.webp';
            $path = 'posts/'.$filename;

            // Resize and convert to webp
            $manager = new ImageManager(new Driver);
            $img = $manager->read($image->getPathname());
            $img->cover(1600, 960);

            Storage::disk('public')->put($path, $img->toWebp(80)->toString());

            $data['image_path'] = $path;
        }

        return $this->postRepo->create($data);
    }

    public function findById(string $id)
    {
        return $this->postRepo->findById($id);
    }

    public function update(string $id, array $data)
    {
        if (isset($data['image_path']) && $data['image_path'] instanceof UploadedFile) {
            $image = $data['image_path'];
            $filename = time().'_'.uniqid().'.webp';
            $path = 'posts/'.$filename;

            // Resize and convert to webp
            $manager = new ImageManager(new Driver);
            $img = $manager->read($image->getPathname());
            $img->cover(1600, 960);

            Storage::disk('public')->put($path, $img->toWebp(80)->toString());

            $data['image_path'] = $path;

            // Delete the old image if exists
            $oldPost = $this->postRepo->findById($id);
            if ($oldPost->image_path && Storage::disk('public')->exists($oldPost->image_path)) {
                Storage::disk('public')->delete($oldPost->image_path);
            }
        } else {
            // Very important: don't overwrite the existing image with null
            unset($data['image_path']);
        }

        return $this->postRepo->update($id, $data);
    }

    public function delete(string $id)
    {
        return $this->postRepo->delete($id);
    }

    public function bulkDelete(array $ids)
    {
        return $this->postRepo->bulkDelete($ids);
    }

    public function bulkUpdateStatus(array $ids, int $status)
    {
        return $this->postRepo->bulkUpdateStatus($ids, $status);
    }
}
