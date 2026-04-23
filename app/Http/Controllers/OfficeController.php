<?php

namespace App\Http\Controllers;

use App\Http\Requests\Office\StoreRequest;
use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offices = Office::all()->map(function ($office) {
            $office->office_name = json_decode($office->office_name, true);
            $office->upazila = json_decode($office->upazila, true);
            $office->district = json_decode($office->district, true);
            return $office;
        });
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
        $data_to_submit = [
            'office_name' => json_encode([
                'bn' => $data['office_name']['bn'],
                'en' => $data['office_name']['en'],
            ]),
            'upazila' => json_encode([
                'bn' => $data['upazila']['bn'],
                'en' => $data['upazila']['en'],
            ]),
            'district' => json_encode([
                'bn' => $data['district']['bn'],
                'en' => $data['district']['en'],
            ]),
            'geo_code' => $data['geo_code'],
            'office_code' => $data['office_code'],
        ];
        Office::create($data_to_submit);
        return redirect()->route('offices.index')->with('success', 'Office created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {
        // Decode JSON fields for the form
        $office->office_name = json_decode($office->office_name, true);
        $office->upazila = json_decode($office->upazila, true);
        $office->district = json_decode($office->district, true);
        return inertia('offices/Edit', [
            'office' => $office,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(\App\Http\Requests\Office\UpdateRequest $request, Office $office)
    {
        $data = $request->validated();
        $data_to_update = [
            'office_name' => json_encode([
                'bn' => $data['office_name']['bn'],
                'en' => $data['office_name']['en'],
            ]),
            'upazila' => json_encode([
                'bn' => $data['upazila']['bn'],
                'en' => $data['upazila']['en'],
            ]),
            'district' => json_encode([
                'bn' => $data['district']['bn'],
                'en' => $data['district']['en'],
            ]),
            'geo_code' => $data['geo_code'],
            'office_code' => $data['office_code'],
        ];
        $office->update($data_to_update);
        $toast = [
          'message' => 'Office updated successfully.', 
          'type' => 'success'
        ];
        return redirect()->route('offices.index')->with('toast', $toast);
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
