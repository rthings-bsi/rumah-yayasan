<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChildDocument extends Model
{
    protected $fillable = [
        'child_id', 'document_type', 'file_path'
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
}
