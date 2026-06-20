<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminBeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::query();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $beritas = $query->latest()->paginate(10)->withQueryString();

        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'category' => 'required|in:Pendidikan,Kesehatan,Sosial,Acara,Umum',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'author'  => 'required|string|max:255',
            'status'  => 'required|in:draft,published',
            'featured' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->except('image');
        $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        $data['featured'] = $request->boolean('featured');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('beritas', 'public');
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dibuat.');
    }

    public function show(Berita $beritum)
    {
        return view('admin.berita.show', compact('beritum'));
    }

    public function edit(Berita $beritum)
    {
        return view('admin.berita.edit', compact('beritum'));
    }

    public function update(Request $request, Berita $beritum)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'category' => 'required|in:Pendidikan,Kesehatan,Sosial,Acara,Umum',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'author'  => 'required|string|max:255',
            'status'  => 'required|in:draft,published',
            'featured' => 'nullable|boolean',
            'published_at' => 'nullable|date',
        ]);

        $data = $request->except('image');
        $data['featured'] = $request->boolean('featured');

        if ($request->title !== $beritum->title) {
            $data['slug'] = Str::slug($request->title) . '-' . Str::random(5);
        }

        if ($request->hasFile('image')) {
            if ($beritum->image) {
                Storage::disk('public')->delete($beritum->image);
            }
            $data['image'] = $request->file('image')->store('beritas', 'public');
        }

        $beritum->update($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $beritum)
    {
        if ($beritum->image) {
            Storage::disk('public')->delete($beritum->image);
        }
        $beritum->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus.');
    }
}
