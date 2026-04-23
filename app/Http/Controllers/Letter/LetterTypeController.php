<?php

namespace App\Http\Controllers\Letter;
use App\Models\LetterType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LetterTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $letter_types = LetterType::all();
        return inertia('letter/LetterType/Index', [
            'letterTypes' => $letter_types,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('letter/LetterType/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:letter_types,name',
            'code' => 'required|integer',
        ]);

        LetterType::create([
            'name' => $request->name,
            'code' => $request->code,
        ]);
        $toast = [
            'type' => 'success',
            'message' => 'Letter type created successfully.',
        ];

        return redirect()->route('letter-types.index')->with('toast', $toast);
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
        $letter_type = LetterType::findOrFail($id);
        return inertia('letter/LetterType/Edit', [
            'letterType' => $letter_type,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:letter_types,name,' . $id,
            'code' => 'required|integer',
        ]);

        $letter_type = LetterType::findOrFail($id);
        $letter_type->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        $toast = [
            'type' => 'success',
            'message' => 'Letter type updated successfully.',
        ];

        return redirect()->route('letter-types.index')->with('toast', $toast);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $letter_type = LetterType::findOrFail($id);
        $letter_type->delete();

        $toast = [
            'type' => 'success',
            'message' => 'Letter type deleted successfully.',
        ];

        return redirect()->route('letter-types.index')->with('toast', $toast);
    }
}
