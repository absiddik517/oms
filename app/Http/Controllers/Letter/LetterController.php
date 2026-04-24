<?php

namespace App\Http\Controllers\Letter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Letter;
use App\Models\Recipient;
use App\Models\Attachment;
use App\Models\Folder;
use App\Models\Office;
use App\Models\Topic;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class LetterController extends Controller
{
    /**
     * List
     */
    public function index()
    {
        $letters = Letter::with(['office', 'topic'])
            ->latest()
            ->get();
        return Inertia::render('letter/letter/Index', [
            'letters' => $letters,
        ]);
    }

    /**
     * Create form
     */
    public function create()
    {
        return Inertia::render('letter/letter/Create', [
            'recipients' => Recipient::all(),
            'offices' => Office::all(),
            'topics' => Topic::all(),
            'folders' => Folder::all(),
        ]);
    }

    /**
     * Store letter
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'office_id' => 'nullable|exists:offices,id',
            'topic_id' => 'nullable|exists:topics,id',
            'folder_id' => 'nullable|exists:folders,id',
            'letter_number' => 'nullable|string',
            'subject' => 'nullable|string',
            'body' => 'nullable|string',
            'letter_date' => 'nullable|date',
            'status' => 'required|in:draft,sent,archived',

            // recipients
            'to' => 'required|exists:recipients,id',
            'cc' => 'nullable|array',
            'cc.*' => 'exists:recipients,id',

            // attachments
            'attachments' => 'nullable|array',
            'attachments.*' => 'file|max:10240',
        ]);

        DB::transaction(function () use ($request, $validated) {

            // 1. Create Letter
            $letter = Letter::create([
                'office_id' => $validated['office_id'] ?? null,
                'topic_id' => $validated['topic_id'] ?? null,
                'folder_id' => $validated['folder_id'] ?? null,
                'letter_number' => $validated['letter_number'] ?? null,
                'subject' => $validated['subject'] ?? null,
                'body' => $validated['body'] ?? null,
                'letter_date' => $validated['letter_date'] ?? null,
                'status' => $validated['status'],
                'created_by' => auth()->id(),
            ]);

            // 2. TO recipient (only one)
            $letter->recipients()->attach($validated['to'], [
                'type' => 'to'
            ]);

            // 3. CC recipients (multiple)
            if (!empty($validated['cc'])) {
                foreach ($validated['cc'] as $cc) {
                    $letter->recipients()->attach($cc, [
                        'type' => 'cc'
                    ]);
                }
            }

            // 4. Attachments upload
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {

                    $path = $file->store('letters', 'public');

                    $attachment = Attachment::create([
                        'file_path' => $path,
                        'file_name' => $file->getClientOriginalName(),
                        'file_type' => $file->getClientMimeType(),
                        'file_size' => $file->getSize(),
                        'uploaded_by' => auth()->id(),
                    ]);

                    $letter->attachments()->attach($attachment->id);
                }
            }
        });

        $toast = [
            'type' => 'success',
            'message' => 'Letter created successfully',
        ];

        return redirect()
            ->route('letters.index')
            ->with('toast', $toast);
    }

    /**
     * Edit form
     */
    public function edit(Letter $letter)
    {
        $letter->load(['recipients', 'attachments']);

        return Inertia::render('letter/letter/Edit', [
            'letter' => $letter,
            'recipients' => Recipient::all(),
        ]);
    }

    /**
     * Update letter
     */
    public function update(Request $request, Letter $letter)
    {
        $validated = $request->validate([
            'office_id' => 'nullable|exists:offices,id',
            'topic_id' => 'nullable|exists:topics,id',
            'folder_id' => 'nullable|exists:folders,id',
            'letter_number' => 'nullable|string',
            'subject' => 'nullable|string',
            'body' => 'nullable|string',
            'letter_date' => 'nullable|date',
            'status' => 'required|in:draft,sent,archived',

            'to' => 'required|exists:recipients,id',
            'cc' => 'nullable|array',
            'cc.*' => 'exists:recipients,id',

            'attachments' => 'nullable|array',
            'attachments.*' => 'file|max:10240',
        ]);

        DB::transaction(function () use ($request, $validated, $letter) {

            // 1. Update Letter
            $letter->update([
                'office_id' => $validated['office_id'] ?? null,
                'topic_id' => $validated['topic_id'] ?? null,
                'folder_id' => $validated['folder_id'] ?? null,
                'letter_number' => $validated['letter_number'] ?? null,
                'subject' => $validated['subject'] ?? null,
                'body' => $validated['body'] ?? null,
                'letter_date' => $validated['letter_date'] ?? null,
                'status' => $validated['status'],
                'updated_by' => auth()->id(),
            ]);

            // 2. Remove old recipients
            $letter->recipients()->detach();

            // 3. Re-attach TO
            $letter->recipients()->attach($validated['to'], [
                'type' => 'to'
            ]);

            // 4. Re-attach CC
            if (!empty($validated['cc'])) {
                foreach ($validated['cc'] as $cc) {
                    $letter->recipients()->attach($cc, [
                        'type' => 'cc'
                    ]);
                }
            }

            // 5. New attachments
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {

                    $path = $file->store('letters', 'public');

                    $attachment = Attachment::create([
                        'file_path' => $path,
                        'file_name' => $file->getClientOriginalName(),
                        'file_type' => $file->getClientMimeType(),
                        'file_size' => $file->getSize(),
                        'uploaded_by' => auth()->id(),
                    ]);

                    $letter->attachments()->attach($attachment->id);
                }
            }
        });

        $toast = [
            'type' => 'success',
            'message' => 'Letter updated successfully',
        ];

        return redirect()
            ->route('letters.index')
            ->with('toast', $toast);
    }

    /**
     * Delete letter
     */
    public function destroy(Letter $letter)
    {
        $letter->delete();

        $toast = [
            'type' => 'success',
            'message' => 'Letter deleted successfully',
        ];

        return back()->with('toast', $toast);
    }
}
