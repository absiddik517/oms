<?php

namespace App\Http\Controllers\Letter;

use App\Http\Controllers\Controller;
use App\Models\Recipient;
use Illuminate\Http\Request;

class RecipientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipients = Recipient::all();
        return inertia('letter/recipient/Index', [
            'recipients' => $recipients, 
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('letter/recipient/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'organization' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
        ]);

        Recipient::create($data);
        $toast = [
            'type' => 'success',
            'message' => 'Recipient created successfully.',
        ];
        return redirect()->route('recipients.index')->with('toast', $toast);
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
        $recipient = Recipient::findOrFail($id);
        return inertia('letter/recipient/Edit', [
            'recipient' => $recipient,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $recipient = Recipient::findOrFail($id);
        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'designation' => ['nullable', 'string', 'max:255'],
            'organization' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
        ]);

        $recipient->update($data);
        $toast = [
            'type' => 'success',
            'message' => 'Recipient updated successfully.',
        ];
        return redirect()->route('recipients.index')->with('toast', $toast);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recipient = Recipient::findOrFail($id);
        $recipient->delete();
        $toast = [
            'type' => 'success',
            'message' => 'Recipient deleted successfully.',
        ];
        return redirect()->route('recipients.index')->with('toast', $toast);
    }
}
