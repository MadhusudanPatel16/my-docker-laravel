<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show Users Table
    public function index()
    {
        // Only active users, exclude admins
        $users = User::active()
            ->where('role', '!=', 'admin')
            ->paginate(5);

        return view('users.index', compact('users'));
    }

    // Store or Update User
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $request->id,
            'role'     => 'required|string|in:user,editor', // disallow admin via form
            'status'   => 'required|string|in:active,inactive,banned',
            'password' => $request->id ? 'nullable|min:6' : 'required|min:6',
        ]);

        $user = User::updateOrCreate(
            ['id' => $request->id],
            [
                'name'     => $request->name,
                'email'    => $request->email,
                'role'     => $request->role,
                'status'   => $request->status,
                'password' => $request->filled('password') ? bcrypt($request->password) : User::find($request->id)->password,
            ]
        );

        return redirect()->route('users.index')->with('success', $request->id ? 'User updated successfully!' : 'User created successfully!');
    }

    // Delete User
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}
