<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProgramController extends Controller
{
    public function index()
    {
        $programs = Program::orderBy('order')->orderBy('name')->paginate(10);
        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|string|max:100',
            'color'       => 'nullable|string|max:20',
            'order'       => 'nullable|integer|min:0',
            'status'      => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name) . '-' . Str::random(4);
        $data['status'] = $request->boolean('status');

        Program::create($data);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program berhasil ditambahkan.');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|string|max:100',
            'color'       => 'nullable|string|max:20',
            'order'       => 'nullable|integer|min:0',
            'status'      => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['status'] = $request->boolean('status');

        if ($request->name !== $program->name) {
            $data['slug'] = Str::slug($request->name) . '-' . Str::random(4);
        }

        $program->update($data);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program berhasil dihapus.');
    }
}
