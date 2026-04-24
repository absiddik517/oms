<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Office;
use App\Models\Officer;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $officers = Officer::with('office')->currentoffice()->get();
        return inertia('officer/Index', [
            'officers' => $officers
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $offices = Office::all();
        return inertia('officer/Create', [
            'offices' => $offices
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'category' => 'required|in:regular,additional,current',
            'address' => 'nullable|string|max:255',
            'status' => 'nullable|in:active,leaved',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'joining_date' => 'nullable|date',
            'leaving_date' => 'required_if:status,leaved|date|after_or_equal:joining_date',
            'office_id' => 'required|exists:offices,id',
        ]);

        Officer::create($request->all());
        $toast = [
            'message' => 'Officer created successfully.',
            'type' => 'success',
        ];

        return redirect()->route('officers.index')->with('toast', $toast);
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
        $officer = Officer::findOrFail($id);
        $offices = Office::all();
        return inertia('officer/Edit', [
            'officer' => $officer,
            'offices' => $offices
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $officer = Officer::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'category' => 'required|in:regular,additional,current',
            'address' => 'nullable|string|max:255',
            'status' => 'required|in:active,leaved',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'joining_date' => 'nullable|date',
            'leaving_date' => 'required_if:status,leaved|date|after_or_equal:joining_date',
            'office_id' => 'required|exists:offices,id',
        ]);

        $officer->update($request->all());
        $toast = [
            'message' => 'Officer updated successfully.',
            'type' => 'success',
        ];

        return redirect()->route('officers.index')->with('toast', $toast);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $officer = Officer::findOrFail($id);
        $officer->delete();
        $toast = [
            'message' => 'Officer deleted successfully.',
            'type' => 'success',
        ];
        return redirect()->route('officers.index')->with('toast', $toast);
    }
}
