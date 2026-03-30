<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    /** @use HasFactory<\Database\Factories\ChildFactory> */
    use HasFactory;

    protected $fillable = [
        'registration_number', 'full_name', 'place_of_birth',
        'date_of_birth', 'gender', 'category', 'enrollment_status', 'admission_date'
    ];

    public function documents()
    {
        return $this->hasMany(ChildDocument::class);
    }
}
