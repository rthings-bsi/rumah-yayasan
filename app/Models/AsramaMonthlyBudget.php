<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsramaMonthlyBudget extends Model
{
    use HasFactory;

    protected $fillable = [
        'asrama_id', 'bulan', 'tahun', 'jumlah_anggaran',
    ];

    public function asrama()
    {
        return $this->belongsTo(Asrama::class);
    }
}
