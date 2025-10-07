<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinanceReport extends Model
{
    /** @use HasFactory<\Database\Factories\FinanceReportFactory> */
    use HasFactory, HasUlids;

    public $incrementing = false;
    protected $keyType = 'string';
}
