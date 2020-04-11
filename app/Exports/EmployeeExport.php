<?php

namespace App\Exports;

use App\Modules\Backend\Employee\Models\Employee;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class EmployeeExport extends DefaultValueBinder implements WithCustomValueBinder, FromCollection, Responsable, WithHeadings, WithMapping
{
    use Exportable;

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_NUMERIC);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'Employees.csv';

    /**
     * Optional Writer Type
     */
    private $writerType = Excel::CSV;

    /**
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    /**
     * Format heading
     */

    public function headings(): array
    {
        return [
            'First name',
            'Last name',
            'Gender',
            'Age',
            'Address',
            'Phone Number',
        ];
    }

    /**
     * @return
     */
    // public function query()
    // {
    //     return Employee::query()->exclude(['id', 'created_at']);
    // }

    /**
     * @return Collection
     */
    public function collection()
    {
        return Employee::exclude(['id', 'created_at'])->get();
    }

    /**
     * @var Employee $employee
     * @return array
     */
    public function map($employee): array
    {
        return [
            $employee->first_name,
            $employee->last_name,
            $employee->gender,
            $employee->age,
            $employee->address,
            $employee->phone_number,
        ];
    }
}
