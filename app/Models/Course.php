<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory, HasUlids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'subject',
        'title',
        'description',
        //'instructor_id',
        'topics',
    ];

    protected $casts = [
        'topics' => 'array',
    ];
}
