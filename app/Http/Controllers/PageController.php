<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gallery;
use App\Models\Program;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $featuredBerita = Berita::where('status', 'published')
            ->where('featured', true)
            ->latest()
            ->take(3)
            ->get();

        $latestBerita = Berita::where('status', 'published')
            ->latest()
            ->take(6)
            ->get();

        $programs = Program::where('status', true)
            ->orderBy('order')
            ->get();

        $settings = SiteSetting::all()->pluck('value', 'key');

        return view('pages.home', compact('featuredBerita', 'latestBerita', 'programs', 'settings'));
    }

    public function about()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('pages.tentang', compact('settings'));
    }

    public function programs()
    {
        $programs = Program::where('status', true)->orderBy('order')->get();
        return view('pages.program', compact('programs'));
    }

    public function blog()
    {
        $beritas = Berita::where('status', 'published')
            ->latest('published_at')
            ->paginate(9);

        $categories = Berita::where('status', 'published')
            ->selectRaw('category, count(*) as total')
            ->groupBy('category')
            ->pluck('total', 'category');

        return view('pages.berita', compact('beritas', 'categories'));
    }

    public function blogShow($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $recentPosts = Berita::where('status', 'published')
            ->where('id', '!=', $berita->id)
            ->latest()
            ->take(4)
            ->get();

        return view('pages.berita-detail', compact('berita', 'recentPosts'));
    }

    public function contact()
    {
        $settings = SiteSetting::all()->pluck('value', 'key');
        return view('pages.kontak', compact('settings'));
    }

    public function gallery()
    {
        $galleries = Gallery::orderBy('order')->latest()->paginate(12);
        return view('pages.galeri', compact('galleries'));
    }
}
