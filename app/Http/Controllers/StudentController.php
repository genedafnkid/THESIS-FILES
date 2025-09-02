<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        // Ensure only students can access these routes
        $this->middleware(['auth', 'role:student']);
    }

    public function index()
    {
        return view('student.dashboard'); // You can create this blade file later
    }
}
