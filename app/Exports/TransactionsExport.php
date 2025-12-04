<?php

namespace App\Exports;

use App\Models\Transactions;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionsExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Transactions::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Amount',
            'Transaction Date',
            'Email',
        ];
    }
}
