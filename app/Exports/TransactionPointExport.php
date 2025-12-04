<?php

namespace App\Exports;

use App\Models\TransactionPoint;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransactionPointExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return TransactionPoint::with(['user', 'course'])
            ->get()
            ->map(function ($transaction) {
                return [
                    'id' => $transaction->id,
                    'user_name' => $transaction->user ? $transaction->user->name : 'N/A',
                    'amount' => $transaction->amount,
                    'type' => $transaction->type,
                    'course_name' => $transaction->course ? $transaction->course->title : 'N/A',
                    'transaction_date' => $transaction->created_at,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'User Name',
            'Amount',
            'Transaction Type',
            'Course Name',
            'Transaction Date',
        ];
    }
}
