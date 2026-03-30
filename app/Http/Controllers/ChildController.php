<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\ChildDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ChildrenExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ChildController extends Controller
{
    public function index(Request $request)
    {
        $query = Child::query();

        $search = $request->search;
        if ($request->filled('search')) {
            $query->where('full_name', 'like', "%{$search}%")
                  ->orWhere('registration_number', 'like', "%{$search}%");
        }

        $children = $query->paginate(15);
        return view('children.index', compact('children', 'search'));
    }

    public function create()
    {
        return view('children.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'registration_number' => 'required|string|unique:children,registration_number',
            'full_name' => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'category' => 'required|in:fatherless,motherless,orphan,underprivileged',
            'enrollment_status' => 'required|in:active,graduated,withdrawn',
            'admission_date' => 'required|date',
            'documents' => 'nullable|array',
            'documents.*.type' => 'required_with:documents|string|in:profile_photo,birth_certificate,family_card,guardian_id',
            'documents.*.file' => 'required_with:documents|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $child = Child::create($request->except('documents'));

        if ($request->has('documents')) {
            foreach ($request->file('documents') as $key => $fileData) {
                if (isset($fileData['file'])) {
                    $path = $fileData['file']->store('documents', 'public');
                    $child->documents()->create([
                        'document_type' => $request->documents[$key]['type'],
                        'file_path' => $path
                    ]);
                }
            }
        }

        return redirect()->route('children.index')->with('success', 'Child record created successfully.');
    }

    public function show(Child $child)
    {
        $child->load('documents');
        return view('children.show', compact('child'));
    }

    public function edit(Child $child)
    {
        return view('children.edit', compact('child'));
    }

    public function update(Request $request, Child $child)
    {
        $validated = $request->validate([
            'registration_number' => 'required|string|unique:children,registration_number,'.$child->id,
            'full_name' => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'category' => 'required|in:fatherless,motherless,orphan,underprivileged',
            'enrollment_status' => 'required|in:active,graduated,withdrawn',
            'admission_date' => 'required|date',
        ]);

        $child->update($validated);

        if ($request->has('documents')) {
            foreach ($request->file('documents') as $key => $fileData) {
                if (isset($fileData['file'])) {
                    $path = $fileData['file']->store('documents', 'public');
                    $child->documents()->create([
                        'document_type' => $request->documents[$key]['type'],
                        'file_path' => $path
                    ]);
                }
            }
        }

        return redirect()->route('children.index')->with('success', 'Child updated successfully.');
    }

    public function destroy(Child $child)
    {
        foreach ($child->documents as $doc) {
            Storage::disk('public')->delete($doc->file_path);
        }
        $child->delete();
        return redirect()->route('children.index')->with('success', 'Child deleted successfully.');
    }

    public function export(Request $request)
    {
        return Excel::download(new ChildrenExport($request->search), 'children.xlsx');
    }

    public function exportPdf(Child $child)
    {
        $child->load('documents');

        // Convert document images to base64 for DomPDF
        foreach ($child->documents as $doc) {
            $fullPath = storage_path('app/public/' . $doc->file_path);
            if (file_exists($fullPath)) {
                $ext = pathinfo($fullPath, PATHINFO_EXTENSION);
                if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png'])) {
                    $doc->base64_image = 'data:image/' . $ext . ';base64,' . base64_encode(file_get_contents($fullPath));
                }
            }
        }

        $pdf = Pdf::loadView('children.pdf', compact('child'))
                  ->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        
        return $pdf->stream('child-profile-' . $child->registration_number . '.pdf');
    }
}
