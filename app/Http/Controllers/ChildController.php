<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Asrama;
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
        $query = Child::query()->with(['asrama', 'documents']);

        $search = $request->search;
        if ($request->filled('search')) {
            $query->where(function($q) use ($search) {
                $q->whereRaw('LOWER(full_name) LIKE ?', ["%".strtolower($search)."%"])
                  ->orWhereRaw('LOWER(registration_number) LIKE ?', ["%".strtolower($search)."%"]);
            });
        }

        if ($request->filled('asrama_id')) {
            $query->where('asrama_id', $request->asrama_id);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('enrollment_status')) {
            $query->where('enrollment_status', $request->enrollment_status);
        }

        $children = $query->paginate(15)->withQueryString();
        $asramas  = Asrama::orderBy('kode_asrama')->get();

        $stats = [
            'total'  => Child::count(),
            'male'   => Child::where('gender', 'male')->count(),
            'female' => Child::where('gender', 'female')->count(),
            'active' => Child::where('enrollment_status', 'active')->count(),
        ];

        return view('children.index', compact('children', 'search', 'asramas', 'stats'));
    }

    public function create(Request $request)
    {
        $asramas = Asrama::orderBy('kode_asrama')->get();
        $selected_asrama_id = $request->asrama_id;
        return view('children.create', compact('asramas', 'selected_asrama_id'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'registration_number' => 'required|string|unique:children,registration_number',
            'full_name'           => 'required|string|max:255',
            'nik'                 => 'nullable|string|max:16',
            'no_kk'               => 'nullable|string|max:16',
            'address'             => 'nullable|string',
            'father_name'         => 'nullable|string|max:255',
            'mother_name'         => 'nullable|string|max:255',
            'grade'               => 'nullable|in:A,B',
            'education_level'     => 'nullable|in:BS,TK,SD,SMP,SMA',
            'class_level'         => 'nullable|string|max:50',
            'recommended_by'      => 'nullable|string|max:255',
            'parent_phone_number' => 'nullable|string|max:15',
            'place_of_birth'      => 'required|string|max:255',
            'date_of_birth'       => 'required|date',
            'gender'              => 'required|in:male,female',
            'category'            => 'required|in:fatherless,motherless,orphan,underprivileged',
            'enrollment_status'   => 'required|in:active,graduated,withdrawn',
            'admission_date'      => 'required|date',
            'asrama_id'           => 'nullable|exists:asramas,id',
            'documents'           => 'nullable|array',
            'documents.*.type'    => 'required_with:documents|string|in:profile_photo,birth_certificate,family_card,guardian_id',
            'documents.*.file'    => 'required_with:documents|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $child = Child::create($request->except('documents'));

        if ($request->has('documents')) {
            foreach ($request->file('documents') as $key => $fileData) {
                if (isset($fileData['file'])) {
                    $path = $fileData['file']->store('documents', 'public');
                    $child->documents()->create([
                        'document_type' => $request->documents[$key]['type'],
                        'file_path'     => $path
                    ]);
                }
            }
        }

        return redirect()->route('children.index')->with('success', __('Child record created successfully.'));
    }

    public function show(Child $child)
    {
        $child->load('documents', 'asrama');
        return view('children.show', compact('child'));
    }

    public function edit(Child $child)
    {
        $asramas = Asrama::orderBy('kode_asrama')->get();
        return view('children.edit', compact('child', 'asramas'));
    }

    public function update(Request $request, Child $child)
    {
        $validated = $request->validate([
            'registration_number' => 'required|string|unique:children,registration_number,'.$child->id,
            'full_name'           => 'required|string|max:255',
            'nik'                 => 'nullable|string|max:16',
            'no_kk'               => 'nullable|string|max:16',
            'address'             => 'nullable|string',
            'father_name'         => 'nullable|string|max:255',
            'mother_name'         => 'nullable|string|max:255',
            'grade'               => 'nullable|in:A,B',
            'education_level'     => 'nullable|in:BS,TK,SD,SMP,SMA',
            'class_level'         => 'nullable|string|max:50',
            'recommended_by'      => 'nullable|string|max:255',
            'parent_phone_number' => 'nullable|string|max:15',
            'place_of_birth'      => 'required|string|max:255',
            'date_of_birth'       => 'required|date',
            'gender'              => 'required|in:male,female',
            'category'            => 'required|in:fatherless,motherless,orphan,underprivileged',
            'enrollment_status'   => 'required|in:active,graduated,withdrawn',
            'admission_date'      => 'required|date',
            'asrama_id'           => 'nullable|exists:asramas,id',
        ]);

        $child->update($validated);

        if ($request->has('documents')) {
            foreach ($request->file('documents') as $key => $fileData) {
                if (isset($fileData['file'])) {
                    $path = $fileData['file']->store('documents', 'public');
                    $child->documents()->create([
                        'document_type' => $request->documents[$key]['type'],
                        'file_path'     => $path
                    ]);
                }
            }
        }

        return redirect()->route('children.index')->with('success', __('Child record updated successfully.'));
    }

    public function destroy(Child $child)
    {
        foreach ($child->documents as $doc) {
            Storage::disk('public')->delete($doc->file_path);
        }
        $child->delete();
        return redirect()->route('children.index')->with('success', __('Child record deleted successfully.'));
    }

    public function destroyDocument(ChildDocument $document)
    {
        Storage::disk('public')->delete($document->file_path);
        $document->delete();
        return back()->with('success', __('Document deleted successfully.'));
    }


    public function export(Request $request)
    {
        if (ob_get_level() > 0) {
            ob_end_clean();
        }
        return Excel::download(new ChildrenExport($request->search, $request->asrama_id), 'data_anak_asrama.xlsx');
    }

    public function exportPdf(Child $child)
    {
        $child->load('documents');

        foreach ($child->documents as $doc) {
            $path = $doc->file_path;
            
            if (Storage::disk('public')->exists($path)) {
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png'])) {
                    $fileContent = Storage::disk('public')->get($path);
                    $doc->base64_image = 'data:image/' . $ext . ';base64,' . base64_encode($fileContent);
                }
            }
        }

        $html = view('children.pdf', compact('child'))->render();
        
        $mpdf = new \Mpdf\Mpdf([
            'tempDir' => '/tmp',
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'format' => 'A4',
            'default_font_size' => 11,
            'default_font' => 'Helvetica'
        ]);

        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        
        return response($mpdf->Output('child-profile-' . $child->registration_number . '.pdf', 'S'), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="child-profile-' . $child->registration_number . '.pdf"'
        ]);
    }

    public function idCard(Child $child)
    {
        $child->load('documents', 'asrama');

        // Prepare base64 image for the profile photo to ensure it renders correctly in print
        $profilePhoto = $child->documents->firstWhere('document_type', 'profile_photo');
        if ($profilePhoto) {
            $path = $profilePhoto->file_path;
            if (Storage::disk('public')->exists($path)) {
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png'])) {
                    $fileContent = Storage::disk('public')->get($path);
                    $profilePhoto->base64_image = 'data:image/' . $ext . ';base64,' . base64_encode($fileContent);
                }
            }
        }

        return view('children.id-card', compact('child'));
    }

    public function generateRegistrationNumber(Request $request)
    {
        $asramaId = $request->asrama_id;
        $date = now();
        $month = $date->format('m');
        $year = $date->format('Y');

        if (!$asramaId) {
            return response()->json(['registration_number' => '']);
        }

        $asrama = Asrama::findOrFail($asramaId);
        $prefix = $asrama->kode_asrama;

        // Count children in this asrama registered in this month and year
        // We use created_at to determine the "running ID" for that period
        $count = Child::where('asrama_id', $asramaId)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();

        $nextId = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        return response()->json([
            'registration_number' => "{$prefix}{$month}{$year}{$nextId}"
        ]);
    }
}