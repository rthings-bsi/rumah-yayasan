<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsramaExpenseItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'expense_report_id', 'kategori', 'deskripsi', 'jumlah',
    ];

    public function report()
    {
        return $this->belongsTo(AsramaExpenseReport::class, 'expense_report_id');
    }

    public function getKategoriLabelAttribute()
    {
        return match($this->kategori) {
            'uang_saku' => 'Uang Saku',
            'logistik' => 'Logistik',
            'transportasi' => 'Transportasi',
            'sewa' => 'Sewa',
            'spp' => 'SPP',
            'token_listrik' => 'Token Listrik',
            'lainnya' => 'Lainnya',
            default => ucfirst($this->kategori)
        };
    }
}
