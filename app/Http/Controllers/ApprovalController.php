<?php

namespace App\Http\Controllers;

use App\Models\AsramaExpenseReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    /**
     * Show reports pending finance approval.
     */
    public function financeIndex(Request $request)
    {
        $query = AsramaExpenseReport::with('asrama', 'submitter')
            ->where('status', 'pending');

        if ($request->filled('asrama_id')) {
            $query->where('asrama_id', $request->asrama_id);
        }

        $reports = $query->orderBy('submitted_at', 'asc')->paginate(15);
        $asramas = \App\Models\Asrama::orderBy('nama_asrama')->get();

        return view('laporan.approval_finance', compact('reports', 'asramas'));
    }

    /**
     * Show reports pending director approval.
     */
    public function directorIndex(Request $request)
    {
        $query = AsramaExpenseReport::with('asrama', 'submitter', 'financeApprover')
            ->where('status', 'finance_approved');

        if ($request->filled('asrama_id')) {
            $query->where('asrama_id', $request->asrama_id);
        }

        $reports = $query->orderBy('finance_approved_at', 'asc')->paginate(15);
        $asramas = \App\Models\Asrama::orderBy('nama_asrama')->get();

        return view('laporan.approval_director', compact('reports', 'asramas'));
    }

    /**
     * Finance approves the report.
     */
    public function financeApprove(Request $request, AsramaExpenseReport $laporan)
    {
        $user = Auth::user();

        if ($user->role !== 'finance' && $user->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        if ($laporan->status !== 'pending') {
            return back()->with('error', 'Laporan tidak dalam status menunggu approval finance.');
        }

        $validated = $request->validate([
            'finance_notes' => 'nullable|string|max:1000',
        ]);

        $laporan->update([
            'status' => 'finance_approved',
            'finance_approved_by' => $user->id,
            'finance_approved_at' => now(),
            'finance_notes' => $validated['finance_notes'],
        ]);

        return redirect()->route('approval.finance.index')
            ->with('success', 'Laporan berhasil disetujui oleh Finance. Menunggu approval Direktur.');
    }

    /**
     * Director approves the report.
     */
    public function directorApprove(Request $request, AsramaExpenseReport $laporan)
    {
        $user = Auth::user();

        if ($user->role !== 'director' && $user->role !== 'admin') {
            abort(403, 'Unauthorized action.');
        }

        if ($laporan->status !== 'finance_approved') {
            return back()->with('error', 'Laporan belum mendapat persetujuan Finance.');
        }

        $validated = $request->validate([
            'director_notes' => 'nullable|string|max:1000',
        ]);

        $laporan->update([
            'status' => 'director_approved',
            'director_approved_by' => $user->id,
            'director_approved_at' => now(),
            'director_notes' => $validated['director_notes'],
        ]);

        return redirect()->route('approval.director.index')
            ->with('success', 'Laporan berhasil disetujui oleh Direktur. Selesai.');
    }

    /**
     * Reject the report (can be done by finance or director).
     */
    public function reject(Request $request, AsramaExpenseReport $laporan)
    {
        $user = Auth::user();

        if (!in_array($user->role, ['finance', 'director', 'admin'])) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'rejection_reason' => 'required|string|min:5|max:2000',
        ]);

        $laporan->update([
            'status' => 'rejected',
            'rejected_by' => $user->id,
            'rejected_at' => now(),
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        return back()->with('success', 'Laporan ditolak. Alasan sudah tercatat.');
    }
}
