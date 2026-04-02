<?php

namespace App\Exports;

use App\Models\Child;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ChildrenExport implements FromCollection, WithHeadings, WithMapping
{
    protected $search;
    protected $asrama_id;

    public function __construct($search = null, $asrama_id = null)
    {
        $this->search = $search;
        $this->asrama_id = $asrama_id;
    }

    public function collection()
    {
        $query = Child::query();
        
        if ($this->asrama_id) {
            $query->where('asrama_id', $this->asrama_id);
        }

        if ($this->search) {
            $query->where(function($q) {
                $q->where('full_name', 'like', "%{$this->search}%")
                  ->orWhere('registration_number', 'like', "%{$this->search}%");
            });
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'No. Registrasi', 'Nama Lengkap', 'NIK', 'No. KK', 'Alamat',
            'Nama Ayah', 'Nama Ibu', 'Grade', 'Jenjang Pendidikan',
            'Kelas', 'Direkomendasikan Oleh', 'No. HP Orang Tua',
            'Tempat Lahir', 'Tanggal Lahir', 'Jenis Kelamin', 'Kategori', 'Status', 'Tanggal Masuk'
        ];
    }

    public function map($child): array
    {
        $gender = $child->gender === 'male' ? 'Laki-laki' : ($child->gender === 'female' ? 'Perempuan' : $child->gender);
        
        $education_level = match($child->education_level) {
            'BS' => 'Belum Sekolah',
            'SD' => 'SD/MI',
            'SMP' => 'SMP/MTs',
            'SMA' => 'SMA/SMK',
            default => $child->education_level
        };

        return [
            $child->id,
            $child->registration_number,
            $child->full_name,
            $child->nik,
            $child->no_kk,
            $child->address,
            $child->father_name,
            $child->mother_name,
            $child->grade,
            $education_level,
            $child->class_level,
            $child->recommended_by,
            $child->parent_phone_number,
            $child->place_of_birth,
            $child->date_of_birth,
            $gender,
            $child->category,
            $child->enrollment_status,
            $child->admission_date,
        ];
    }
}
