<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ModuleController extends Controller
{
    /**
     * Display a listing of the modules.
     */
    public function index()
    {
        // Get all modules with user relationship
        $modules = Module::with('user')->latest()->get();
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
        // ✅ Validate input
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'file'        => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,ppt,pptx,xls,xlsx,txt|max:10240',
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            // Store file inside storage/app/public/modules
            $filePath = $request->file('file')->store('modules', 'public');
        }

        // ✅ Create module
        $module = Module::create([
            'title'       => $request->title,
            'description' => $request->description,
            'file_path'   => $filePath,
        ]);

        return redirect()
            ->route('modules.index')
            ->with('success', 'Module created successfully!');
    }


    /**
     * Display the specified module.
     */
    public function show($id)
    {
        $module = Module::with('user')->findOrFail($id);
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
        $module = Module::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'nullable|mimes:pdf,docx,pptx,jpg,jpeg,png|max:10240', // 10MB
        ]);

        $module->title = $request->input('title');
        $module->description = $request->input('description');

        // ✅ Handle file replacement
        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($module->file_path && Storage::disk('public')->exists($module->file_path)) {
                Storage::disk('public')->delete($module->file_path);
            }

            // Store new file
            $path = $request->file('file')->store('modules', 'public');
            $module->file_path = $path;
        }

        $module->save();

        return redirect()->route('modules.index')->with('success', 'Module updated successfully.');
    }


    /**
     * Remove the specified module from storage.
     */
    public function destroy($id)
    {
        $module = Module::findOrFail($id);

        // delete file from storage if exists
        if ($module->file_path && Storage::disk('public')->exists($module->file_path)) {
            Storage::disk('public')->delete($module->file_path);
        }

        $module->delete();

        return redirect()->route('modules.index')->with('success', 'Module deleted successfully.');
    }


}
