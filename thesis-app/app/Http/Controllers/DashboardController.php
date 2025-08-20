<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement; // import your model

class DashboardController extends Controller
{
    public function index()
    {
        // Get all announcements, newest first
        $announcements = Announcement::latest()->get();

        // Pass them to the dashboard view
        return view('dashboard', compact('announcements'));
    }
}
