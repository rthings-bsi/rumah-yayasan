<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total' => Child::count(),
            'graduated' => Child::where('enrollment_status', 'graduated')->count(),
            'active' => Child::where('enrollment_status', 'active')->count(),
            'by_category' => Child::selectRaw('category, count(*) as total')
                                  ->groupBy('category')
                                  ->pluck('total', 'category')
        ];

        return view('dashboard', compact('stats'));
    }
}
