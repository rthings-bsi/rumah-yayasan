<?php

namespace App\Http\Controllers;

use App\Models\Asrama;
use App\Models\Child;
use Illuminate\Http\Request;

class AsramaController extends Controller
{
    public function index()
    {
        $asramas = Asrama::withCount('children')
                         ->withCount(['children as active_children_count' => function ($q) {
                             $q->where('enrollment_status', 'active');
                         }])
                         ->orderBy('kode_asrama')
                         ->get();
        return view('asramas.index', compact('asramas'));
    }

    public function show(Asrama $asrama)
    {
        $asrama->loadCount([
            'children',
            'children as active_count' => function ($q) { $q->where('enrollment_status', 'active'); },
            'children as graduated_count' => function ($q) { $q->where('enrollment_status', 'graduated'); }
        ]);

        $children = $asrama->children()
                           ->orderBy('full_name')
                           ->paginate(20);

        return view('asramas.show', compact('asrama', 'children'));
    }

    public function create()
    {
        return view('asramas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_asrama' => 'required|string|max:10|unique:asramas,kode_asrama',
            'nama_asrama' => 'required|string|max:255',
        ]);

        Asrama::create($validated);

        return redirect()->route('asramas.index')
                         ->with('success', 'Asrama berhasil ditambahkan.');
    }

    public function edit(Asrama $asrama)
    {
        return view('asramas.edit', compact('asrama'));
    }

    public function update(Request $request, Asrama $asrama)
    {
        $validated = $request->validate([
            'kode_asrama' => 'required|string|max:10|unique:asramas,kode_asrama,' . $asrama->id,
            'nama_asrama' => 'required|string|max:255',
        ]);

        $asrama->update($validated);

        return redirect()->route('asramas.index')
                         ->with('success', 'Data asrama berhasil diperbarui.');
    }

    public function destroy(Asrama $asrama)
    {
        // Null-ify children before deleting (onDelete nullOnDelete handles this in DB,
        // but we set explicitly for safety)
        $asrama->children()->update(['asrama_id' => null]);
        $asrama->delete();

        return redirect()->route('asramas.index')
                         ->with('success', 'Asrama berhasil dihapus.');
    }
}
