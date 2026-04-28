<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use App\Http\Requests\RegisterFormRequest;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginFormRequest $request)
    {
        $response = $this->authService->login($request->validated(), $request->boolean('remember'));

        if ($response['status']) {
            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => $response['message'],
        ]);
    }

    public function register(RegisterFormRequest $request)
    {
        $this->authService->register($request->validated());

        return redirect()->route('admin.dashboard')
            ->with('success', 'Registration successful');
    }

    public function logout(Request $request)
    {
        // dd($request->all());
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.view');
    }
}
