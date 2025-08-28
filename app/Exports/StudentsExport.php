<?php

namespace App\Exports;

use App\Models\StudentRegister;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class StudentsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StudentRegister::all();
    }
    public function map($student): array
    {
        return [
            $student->full_name,
            $student->father_name,
            $student->gender,
            $student->cnic_number,
            $student->email,
            $student->contact_number,
            $student->date_of_birth,
            $student->domicile_district,
            $student->university_name,
        ];
    }

    public function headings(): array
    {
        return [
            'Full Name',
            'Father Name',
            'Gender',
            'CNIC Number',
            'Email',
            'Contact Number',
            'Date of Birth',
            'Domicile District',
            'University Name',
        ];
    }
}
