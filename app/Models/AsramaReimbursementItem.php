<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsramaReimbursementItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_report_id', 'deskripsi', 'jumlah',
    ];

    public function report()
    {
        return $this->belongsTo(AsramaExpenseReport::class, 'expense_report_id');
    }
}
