<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;

class ModuleController extends Controller
{
    /**
     * Display a listing of the modules.
     */
    public function index()
    {
        $modules = Module::all();
        return view('modules', compact('modules'));
    }

    /**
     * Show the form for creating a new module.
     */
    public function create()
    {
        return view('modules.create');
    }

    /**
     * Store a newly created module in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Create the module
        Module::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('modules.index')
            ->with('success', 'Module created successfully.');
    }

    /**
     * Display the specified module.
     */
    public function show($id)
    {
        $module = Module::findOrFail($id);
        return view('modules.show', compact('module'));
    }

    /**
     * Show the form for editing the specified module.
     */
    public function edit($id)
    {
        $module = Module::findOrFail($id);
        return view('modules.edit', compact('module'));
    }

    /**
     * Update the specified module in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $module = Module::findOrFail($id);
        $module->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()
            ->route('modules.index')
            ->with('success', 'Module updated successfully.');
    }

    /**
     * Remove the specified module from storage.
     */
    public function destroy($id)
    {
        $module = Module::findOrFail($id);
        $module->delete();

        return redirect()
            ->route('modules.index')
            ->with('success', 'Module deleted successfully.');
    }
}
