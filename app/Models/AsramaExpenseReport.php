<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsramaExpenseReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'asrama_id', 'bulan', 'tahun', 'status',
        'submitted_by', 'submitted_at',
        'finance_approved_by', 'finance_approved_at', 'finance_notes',
        'director_approved_by', 'director_approved_at', 'director_notes',
        'rejected_by', 'rejected_at', 'rejection_reason',
        'total_pengeluaran', 'total_reimbursement',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'finance_approved_at' => 'datetime',
        'director_approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'total_pengeluaran' => 'decimal:2',
        'total_reimbursement' => 'decimal:2',
    ];

    public function asrama()
    {
        return $this->belongsTo(Asrama::class);
    }

    public function expenseItems()
    {
        return $this->hasMany(AsramaExpenseItem::class, 'expense_report_id');
    }

    public function reimbursementItems()
    {
        return $this->hasMany(AsramaReimbursementItem::class, 'expense_report_id');
    }

    public function submitter()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function financeApprover()
    {
        return $this->belongsTo(User::class, 'finance_approved_by');
    }

    public function directorApprover()
    {
        return $this->belongsTo(User::class, 'director_approved_by');
    }

    public function rejector()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    public function scopeForAsrama($query, $asramaId)
    {
        return $query->where('asrama_id', $asramaId);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByMonth($query, $bulan, $tahun)
    {
        return $query->where('bulan', $bulan)->where('tahun', $tahun);
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'draft' => 'bg-slate-100 text-slate-600 dark:bg-slate-700 dark:text-slate-300',
            'pending' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400',
            'finance_approved' => 'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-400',
            'director_approved' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400',
            'rejected' => 'bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400',
            default => 'bg-slate-100 text-slate-600'
        };
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'draft' => 'Draft',
            'pending' => 'Menunggu Finance',
            'finance_approved' => 'Disetujui Finance',
            'director_approved' => 'Disetujui Direktur',
            'rejected' => 'Ditolak',
            default => $this->status
        };
    }
}
