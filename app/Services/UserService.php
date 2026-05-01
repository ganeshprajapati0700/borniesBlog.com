<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    protected $userRepository;

    /**
     * Create a new class instance.
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function paginate(array $filters, $perPage = 15)
    {
        return $this->userRepository->paginate($filters, $perPage);
    }

    public function create(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function findById(string $id)
    {
        return $this->userRepository->findById($id);
    }

    public function update(string $id, array $data)
    {
        return $this->userRepository->update($id, $data);
    }

    public function delete(string $id)
    {
        return $this->userRepository->delete($id);
    }
}
