<?php
namespace App\Exports;

use App\Models\Examination;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExaminationsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Examination::select('id', 'student_id', 'subject', 'exam_date', 'score')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Student ID', 'Subject', 'Exam Date', 'Score'];
    }
}
