<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;
use App\Traits\LogsActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use LogsActivity;

    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'status', 'role']);
        $data = $this->userService->paginate($filters, 15);

        return view('admin.users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserFormRequest $request)
    {
        // dd($request->all());
        $data = $request->validated();
        $user = $this->userService->create($data);

        $this->logActivity('created', 'User', $user->id, "Created user \"{$user->name}\"");

        return redirect()->route('users.index')->with('success', 'User Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = $this->userService->findById($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserFormRequest $request, string $id)
    {
        $validated = $request->validated();
        // Remove password from the array if it's empty to avoid overwriting with null
        if (! empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }
        $user = $this->userService->update($id, $validated);

        $this->logActivity('updated', 'User', $id, "Updated user \"{$user->name}\"");

        return redirect()->route('users.index')->with('success', 'User Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = $this->userService->findById($id);
        $this->userService->delete($id);

        $this->logActivity('deleted', 'User', $id, "Deleted user \"{$user->name}\"");

        return redirect()->route('users.index')->with('success', 'User Deleted Successfully.');
    }

    /** Toggle user active/inactive status via AJAX. */
    public function toggleStatus(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status == 1 ? 0 : 1;
        $user->save();

        return response()->json(['status' => (int) $user->status]);
    }
}
