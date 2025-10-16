<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    public function __construct()
    {
        // Require login
        $this->middleware('auth');
    }

    public function index()
    {
        // Load announcements newest first with user relation
        $announcements = Announcement::with('user')->latest()->get();

        // Render your dashboard view (the one you pasted) and pass $announcements
        return view('dashboard', compact('announcements'));
    }

    public function store(Request $request)
    {
        $this->authorizeRole(); // allow only admin/instructor

        $validated = $request->validate([
            'content' => ['required', 'string', 'max:5000'],
        ]);

        Announcement::create([
            'content' => $validated['content'],
            'user_id' => Auth::id(),
        ]);

        return back()->with('success', 'Announcement posted.');
    }

    public function update(Request $request, Announcement $announcement)
    {
        $this->authorizeRole(); // allow only admin/instructor

        $validated = $request->validate([
            'content' => ['required', 'string', 'max:5000'],
        ]);

        $announcement->update($validated);

        return back()->with('success', 'Announcement updated.');
    }

    public function destroy(Announcement $announcement)
    {
        $this->authorizeRole(); // allow only admin/instructor

        $announcement->delete();

        return back()->with('success', 'Announcement deleted.');
    }

    private function authorizeRole(): void
    {
        // If using spatie/laravel-permission:
        if (!auth()->user()->hasAnyRole(['admin', 'instructor'])) {
            abort(403, 'Unauthorized.');
        }
    }
}
