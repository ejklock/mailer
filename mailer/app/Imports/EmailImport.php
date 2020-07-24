<?php

namespace App\Imports;

use App\Models\Email;
use App\Models\UniRedeMail;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;

class EmailImport implements ToModel, WithHeadingRow, WithValidation, ToCollection
{
    use Importable, SkipsFailures;
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    public function rules(): array
    {
        return [
            'email' => 'email:rfc,dns'
        ];
    }

    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.email' => 'email:rfc,dns',
        ])->validate();
        foreach ($rows as $row) {
            new UniRedeMail([
                'email' => $row['email']
            ]);
        }
    }

    public function model(array $row)
    {
        return new UniRedeMail([
            'email' => $row['email']
        ]);
    }
}
