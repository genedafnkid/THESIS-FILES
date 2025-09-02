<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstructorController extends Controller
{
    public function __construct()
    {
        // Ensure only instructors can access these routes
        $this->middleware(['auth', 'role:instructor']);
    }

    public function index()
    {
        return view('instructor.dashboard'); // You can create this blade file later
    }
}