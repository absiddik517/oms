<?php

namespace App\Http\Controllers\Letter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subject\StoreRequest;
use App\Http\Requests\Subject\UpdateRequest;
use App\Models\Office;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $topics = Topic::currentOffice()->get();
        return inertia('letter/topic/Index', [
            'topics' => $topics,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $offices = Office::all();
        return inertia('letter/topic/Create',[
            "offices" => $offices
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        Topic::create([
            'office_id' => $request->office_id,
            'name' => $request->name,
            'code' => $request->code,
        ]);
        $toast = [
            'type' => 'success',
            'message' => 'Topic created successfully.',
        ];

        return redirect()->route('topic.index')->with('toast', $toast);
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
        $topic = Topic::findOrFail($id);
        return inertia('letter/topic/Edit', [
            'topic' => $topic,
            "offices" => Office::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $topic = Topic::findOrFail($id);
        $topic->update([
            'office_id' => $request->office_id,
            'name' => $request->name,
            'code' => $request->code,
        ]);

        $toast = [
            'type' => 'success',
            'message' => 'Topic updated successfully.',
        ];

        return redirect()->route('topic.index')->with('toast', $toast);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $topic = Topic::findOrFail($id);
        $topic->delete();

        $toast = [
            'type' => 'success',
            'message' => 'Topic deleted successfully.',
        ];

        return redirect()->route('topic.index')->with('toast', $toast);
    }
}
