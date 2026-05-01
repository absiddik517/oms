<?php

namespace App\Http\Controllers\Letter;
use App\Models\Office;

use App\Http\Controllers\Controller;
use App\Models\Folder;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $folders = Folder::all();
        return inertia('letter/folder/Index', [
            'folders' => $folders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $offices = Office::all();
        return inertia('letter/folder/Create', [
            'offices' => $offices,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'code' => ['required'],
            'office_id' => ['required', 'exists:offices,id'],
        ]);

        Folder::create([
            'name' => $request->name,
            'description' => $request->description,
            'code' => $request->code,
            'office_id' => $request->office_id,
        ]);
        $toast = [
            'message' => 'Folder created successfully.',
            'type' => 'success',
        ];

        return redirect()->route('folders.index')->with('toast', $toast);
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
        $folder = Folder::findOrFail($id);
        abort_if(
            auth()->user()->role == 'user' && auth()->user()->office_id !== $folder->office_id,
            403,
            "You are not auhorized to edit the folder."
        );
        $offices = Office::all();
        return inertia('letter/folder/Edit', [
            'folder' => $folder,
            'offices' => $offices,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $folder = Folder::findOrFail($id);
        abort_if(
            auth()->user()->role == 'user' && auth()->user()->office_id !== $folder->office_id,
            403,
            "You are not auhorized to edit the folder."
        );
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'code' => ['required'],
            'office_id' => ['required', 'exists:offices,id'],
        ]);

        $folder->update([
            'name' => $request->name,
            'description' => $request->description,
            'code' => $request->code,
            'office_id' => $request->office_id,
        ]);
        $toast = [
            'message' => 'Folder updated successfully.',
            'type' => 'success',
        ];

        return redirect()->route('folders.index')->with('toast', $toast);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $folder = Folder::findOrFail($id);
        abort_if(
            auth()->user()->role == 'user' && auth()->user()->office_id !== $folder->office_id,
            403,
            "You are not auhorized to edit the folder."
        );
        $folder->delete();
        $toast = [
            'message' => 'Folder deleted successfully.',
            'type' => 'success',
        ];
        return redirect()->route('folders.index')->with('toast', $toast);
    }
}
