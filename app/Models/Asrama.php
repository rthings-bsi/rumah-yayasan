<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asrama extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_asrama',
        'nama_asrama',
    ];

    public function children()
    {
        return $this->hasMany(Child::class);
    }

    public function activeChildren()
    {
        return $this->hasMany(Child::class)->where('enrollment_status', 'active');
    }
}
