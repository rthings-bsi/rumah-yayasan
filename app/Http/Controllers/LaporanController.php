<?php

namespace App\Http\Controllers;

use App\Models\Asrama;
use App\Models\AsramaExpenseReport;
use App\Models\AsramaExpenseItem;
use App\Models\AsramaReimbursementItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    /**
     * Display a listing of expense reports.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $query = AsramaExpenseReport::with('asrama', 'submitter');

        // Filter by role
        if ($user->role === 'asrama_admin') {
            $asramaIds = Asrama::pluck('id'); // or filter by assigned asrama
            $query->whereIn('asrama_id', $asramaIds);
        }

        // Optional filters
        if ($request->filled('asrama_id')) {
            $query->where('asrama_id', $request->asrama_id);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        if ($request->filled('bulan')) {
            $query->where('bulan', $request->bulan);
        }
        if ($request->filled('tahun')) {
            $query->where('tahun', $request->tahun);
        }

        $reports = $query->orderBy('created_at', 'desc')->paginate(15);
        $asramas = Asrama::orderBy('nama_asrama')->get();

        return view('laporan.index', compact('reports', 'asramas'));
    }

    /**
     * Show the form for creating a new report.
     */
    public function create()
    {
        $asramas = Asrama::orderBy('nama_asrama')->get();
        return view('laporan.create', compact('asramas'));
    }

    /**
     * Store a newly created report.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'asrama_id' => 'required|exists:asramas,id',
            'bulan' => 'required|integer|min:1|max:12',
            'tahun' => 'required|integer|min:2020|max:2099',
        ]);

        // Check if report already exists for this asrama/month
        $exists = AsramaExpenseReport::where('asrama_id', $validated['asrama_id'])
            ->where('bulan', $validated['bulan'])
            ->where('tahun', $validated['tahun'])
            ->exists();

        if ($exists) {
            return back()->withErrors(['bulan' => 'Laporan untuk asrama dan bulan ini sudah ada.'])->withInput();
        }

        $report = AsramaExpenseReport::create([
            'asrama_id' => $validated['asrama_id'],
            'bulan' => $validated['bulan'],
            'tahun' => $validated['tahun'],
            'status' => 'draft',
        ]);

        return redirect()->route('laporan.edit', $report)
            ->with('success', 'Laporan berhasil dibuat. Silakan tambahkan item pengeluaran.');
    }

    /**
     * Display the specified report.
     */
    public function show(AsramaExpenseReport $laporan)
    {
        $laporan->load([
            'asrama',
            'expenseItems',
            'reimbursementItems',
            'submitter',
            'financeApprover',
            'directorApprover',
            'rejector',
        ]);

        return view('laporan.show', compact('laporan'));
    }

    /**
     * Show the form for editing the report (add items).
     */
    public function edit(AsramaExpenseReport $laporan)
    {
        if ($laporan->status !== 'draft') {
            return redirect()->route('laporan.show', $laporan)
                ->with('error', 'Laporan sudah tidak bisa diedit karena sudah diproses.');
        }

        $laporan->load(['expenseItems', 'reimbursementItems', 'asrama']);

        $kategoriList = [
            'uang_saku' => 'Uang Saku',
            'logistik' => 'Logistik',
            'transportasi' => 'Transportasi',
            'sewa' => 'Sewa',
            'spp' => 'SPP',
            'token_listrik' => 'Token Listrik',
            'lainnya' => 'Lainnya',
        ];

        return view('laporan.edit', compact('laporan', 'kategoriList'));
    }

    /**
     * Update the report metadata.
     */
    public function update(Request $request, AsramaExpenseReport $laporan)
    {
        if ($laporan->status !== 'draft') {
            return back()->with('error', 'Laporan sudah tidak bisa diedit.');
        }

        // Only update if still valid
        // (items are managed via addExpenseItem, addReimbursementItem)
        return redirect()->route('laporan.edit', $laporan)
            ->with('success', 'Laporan diperbarui.');
    }

    /**
     * Add an expense item to the report.
     */
    public function addExpenseItem(Request $request, AsramaExpenseReport $laporan)
    {
        if ($laporan->status !== 'draft') {
            return back()->with('error', 'Laporan sudah tidak bisa diedit.');
        }

        $validated = $request->validate([
            'kategori' => 'required|in:uang_saku,logistik,transportasi,sewa,spp,token_listrik,lainnya',
            'deskripsi' => 'required|string|max:500',
            'jumlah' => 'required|numeric|min:0',
        ]);

        AsramaExpenseItem::create([
            'expense_report_id' => $laporan->id,
            'kategori' => $validated['kategori'],
            'deskripsi' => $validated['deskripsi'],
            'jumlah' => $validated['jumlah'],
        ]);

        // Recalculate total
        $this->recalculateTotals($laporan);

        return back()->with('success', 'Item pengeluaran berhasil ditambahkan.');
    }

    /**
     * Remove an expense item.
     */
    public function removeExpenseItem(AsramaExpenseReport $laporan, AsramaExpenseItem $item)
    {
        if ($laporan->status !== 'draft') {
            return back()->with('error', 'Laporan sudah tidak bisa diedit.');
        }

        $item->delete();
        $this->recalculateTotals($laporan);

        return back()->with('success', 'Item pengeluaran berhasil dihapus.');
    }

    /**
     * Add a reimbursement item to the report.
     */
    public function addReimbursementItem(Request $request, AsramaExpenseReport $laporan)
    {
        if ($laporan->status !== 'draft') {
            return back()->with('error', 'Laporan sudah tidak bisa diedit.');
        }

        $validated = $request->validate([
            'deskripsi' => 'required|string|max:500',
            'jumlah' => 'required|numeric|min:0',
        ]);

        AsramaReimbursementItem::create([
            'expense_report_id' => $laporan->id,
            'deskripsi' => $validated['deskripsi'],
            'jumlah' => $validated['jumlah'],
        ]);

        // Recalculate total
        $this->recalculateTotals($laporan);

        return back()->with('success', 'Item reimbursement berhasil ditambahkan.');
    }

    /**
     * Remove a reimbursement item.
     */
    public function removeReimbursementItem(AsramaExpenseReport $laporan, AsramaReimbursementItem $item)
    {
        if ($laporan->status !== 'draft') {
            return back()->with('error', 'Laporan sudah tidak bisa diedit.');
        }

        $item->delete();
        $this->recalculateTotals($laporan);

        return back()->with('success', 'Item reimbursement berhasil dihapus.');
    }

    /**
     * Submit the report for approval.
     */
    public function submit(AsramaExpenseReport $laporan)
    {
        if ($laporan->status !== 'draft') {
            return back()->with('error', 'Laporan sudah diproses.');
        }

        if ($laporan->expenseItems()->count() === 0) {
            return back()->with('error', 'Minimal ada satu item pengeluaran sebelum submit.');
        }

        $laporan->update([
            'status' => 'pending',
            'submitted_by' => Auth::id(),
            'submitted_at' => now(),
        ]);

        return redirect()->route('laporan.show', $laporan)
            ->with('success', 'Laporan berhasil dikirim untuk diverifikasi Finance.');
    }

    /**
     * Recalculate totals for the report.
     */
    private function recalculateTotals(AsramaExpenseReport $laporan)
    {
        $totalPengeluaran = $laporan->expenseItems()->sum('jumlah');
        $totalReimbursement = $laporan->reimbursementItems()->sum('jumlah');

        $laporan->updateQuietly([
            'total_pengeluaran' => $totalPengeluaran,
            'total_reimbursement' => $totalReimbursement,
        ]);
    }
}
