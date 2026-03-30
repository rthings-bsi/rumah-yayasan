<?php

namespace App\Exports;

use App\Models\Child;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ChildrenExport implements FromCollection, WithHeadings, WithMapping
{
    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function collection()
    {
        $query = Child::query();
        if ($this->search) {
            $query->where('full_name', 'like', "%{$this->search}%")
                  ->orWhere('registration_number', 'like', "%{$this->search}%");
        }
        return $query->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Registration Number', 'Full Name', 'Place of Birth',
            'Date of Birth', 'Gender', 'Category', 'Status', 'Admission Date'
        ];
    }

    public function map($child): array
    {
        return [
            $child->id,
            $child->registration_number,
            $child->full_name,
            $child->place_of_birth,
            $child->date_of_birth,
            $child->gender,
            $child->category,
            $child->enrollment_status,
            $child->admission_date,
        ];
    }
}
