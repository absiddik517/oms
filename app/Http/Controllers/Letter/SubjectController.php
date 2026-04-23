<?php

namespace App\Http\Controllers\Letter;
use App\Models\LetterType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subject\StoreRequest;
use App\Http\Requests\Subject\UpdateRequest;
use App\Models\Office;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::all();
        return inertia('letter/subject/Index', [
            'subjects' => $subjects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $offices = Office::all();
        return inertia('letter/subject/Create',[
            "offices" => $offices
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        Subject::create([
            'office_id' => $request->office_id,
            'name' => $request->name,
            'code' => $request->code,
        ]);
        $toast = [
            'type' => 'success',
            'message' => 'Subject created successfully.',
        ];

        return redirect()->route('subject.index')->with('toast', $toast);
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
        $subject = Subject::findOrFail($id);
        return inertia('letter/subject/Edit', [
            'subject' => $subject,
            "offices" => Office::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->update([
            'office_id' => $request->office_id,
            'name' => $request->name,
            'code' => $request->code,
        ]);

        $toast = [
            'type' => 'success',
            'message' => 'Subject updated successfully.',
        ];

        return redirect()->route('subject.index')->with('toast', $toast);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        $toast = [
            'type' => 'success',
            'message' => 'Subject deleted successfully.',
        ];

        return redirect()->route('subject.index')->with('toast', $toast);
    }
}
