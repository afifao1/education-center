<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Exports\ExaminationsExport;
use App\Models\Examination;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportExcel()
    {
        return Excel::download(new ExaminationsExport, 'examinations.xlsx');
    }

    public function exportPDF()
    {
        $examinations = Examination::with('student')->get();

        $pdf = Pdf::loadView('examinations.pdf', compact('examinations'));

        return Response::make($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="examinations.pdf"',
        ]);
    }
}
