<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('office')->get();
        return inertia('user/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $offices = Office::all();
        return inertia('user/Create', [
            'offices' => $offices,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'office_id' => 'nullable|exists:offices,id',
            'role' => 'required|in:admin,user',
            'password' => 'required|string|min:8',
        ]);

        User::create($data);
        $toast = [
            'type' => 'success',
            'message' => 'User created successfully.',
        ];
        return redirect()->route('users.index')->with('toast', $toast);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $offices = Office::all();
        return inertia('user/Edit', [
            'user' => $user,
            'offices' => $offices,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $row = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'office_id' => 'nullable|exists:offices,id',
            'role' => 'required|in:admin,user',
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->update($row);
        $toast = [
            'type' => 'success',
            'message' => 'User updated successfully.',
        ];
        return redirect()->back()->with('toast', $toast);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $toast = [
            'type' => 'success',
            'message' => 'User deleted successfully.',
        ];
        return redirect()->route('users.index')->with('toast', $toast);
    }
}
