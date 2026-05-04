<?php

namespace App\Services;

use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    protected $adminRepo;

    public function __construct(AdminRepositoryInterface $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }

    public function login(array $credentials, bool $remember)
    {

        if (! Auth::attempt($credentials, $remember)) {
            return [
                'status' => false,
                'message' => 'Invalid Credentials',
            ];
        }

        $user = Auth::user();

        if ($user->status == 0) {
            // Auth::logout();

            return [
                'status' => false,
                'message' => 'Account inactive',
            ];
        }

        return [
            'status' => true,
            'message' => 'Login successful',
        ];
    }

    public function register(array $data)
    {

        // dd($data);
        $data['password'] = Hash::make($data['password']);
        $data['status'] = 1;
        $data['role'] = \App\Models\User::ROLE_ADMIN;
        // dd($data);
        $user = $this->adminRepo->create($data);
        Auth::login($user);

        return $user;
    }
}
