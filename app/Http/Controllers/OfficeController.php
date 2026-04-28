<?php

namespace App\Http\Controllers;

use App\Http\Requests\Office\StoreRequest;
use App\Http\Requests\Office\UpdateRequest;
use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function __construct()
    {
        abort_if(auth()->user()->role !== 'admin', 403, "Access Denied!");
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $offices = Office::all();
        // dd($offices->toArray());
        return inertia('offices/Index', [
            'offices' => $offices,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('offices/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $exist = Office::where('office_name->en', $data['office_name']['en'])
                ->where('office_name->bn', $data['office_name']['bn'])
                ->where('upazila->bn', $data['upazila']['bn'])
                ->where('district->bn', $data['district']['bn'])
                ->count();
        if($exist) return redirect()->back()->with('toast', [
            'type' => 'error',
            'message' => 'Office Already Exist!'
        ]);
        Office::create($data);
        return redirect()->route('offices.index')->with('success', 'Office created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        return inertia('offices/Show', [
            'office' => $office
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {
        return inertia('offices/Edit', [
            'office' => $office,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Office $office)
    {
        $data = $request->validated();
        try{
            $office->update($data);
            $toast = [
              'message' => 'Office updated successfully.', 
              'type' => 'success'
            ];
            }catch(\Exception $e){
                $toast = [
                    'message' => $e->getMessage(),
                    'type' => 'error',
                ];
            }
            return redirect()->back()->with('toast', $toast);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {
        $office->delete();
        return redirect()->route('offices.index')->with('success', 'Office deleted successfully.');
    }
}
