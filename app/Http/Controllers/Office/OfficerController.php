<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Http\Requests\Officer\StoreRequest;
use App\Http\Requests\Officer\UpdateRequest;
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
        $officers = Officer::with('office')->get();
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
    public function store(StoreRequest $request)
    {
        Officer::create($request->validated());
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
    public function update(UpdateRequest $request, string $id)
    {
        $officer = Officer::findOrFail($id);
        abort_if(
            auth()->user()->role == 'user' && auth()->user()->office_id !== $officer->office_id,
            403,
            "You are not auhorized to edit the officer."
        );
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
        abort_if(
            auth()->user()->role == 'user' && auth()->user()->office_id !== $officer->office_id,
            403,
            "You are not auhorized to delete the officer."
        );
        $officer->delete();
        $toast = [
            'message' => 'Officer deleted successfully.',
            'type' => 'success',
        ];
        return redirect()->route('officers.index')->with('toast', $toast);
    }
}
