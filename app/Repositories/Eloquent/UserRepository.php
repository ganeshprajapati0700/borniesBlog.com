<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function paginate(array $filters, int $perPage = 15)
    {
        return User::query()
            ->when(isset($filters['search']) && $filters['search'] !== '', function ($query) use ($filters) {
                $search = $filters['search'];
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->when(isset($filters['status']) && $filters['status'] !== '', function ($query) use ($filters) {
                $query->where('status', $filters['status']);
            })
            ->when(isset($filters['role']) && $filters['role'] !== '', function ($query) use ($filters) {
                $query->where('is_admin', $filters['role']);
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    public function create(array $data)
    {
        // dd($data);
        return User::create($data);
    }

    public function findById(string $id)
    {
        return User::findOrFail($id);
    }

    public function update(string $id, array $data)
    {
        // dd($data);
        // if (empty($data['role'])) {
        $data['is_admin'] = $data['role'];
        // }
        // dd($data);
        $user = User::findOrFail($id);
        $user->update($data);

        return $user;
    }

    public function delete(string $id)
    {
        $user = User::findOrFail($id);

        return $user->delete();
    }
}
