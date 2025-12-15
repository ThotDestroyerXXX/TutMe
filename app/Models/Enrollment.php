<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    /** @use HasFactory<\Database\Factories\EnrollmentFactory> */
    use HasFactory, HasUlids;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'course_id',
        'point_spent',
        'grade',
        'status',
        'recording',
        'date',
        'created_at',
        'updated_at',
    ];

    public function Enrollments(){
        return [
            $this->belongsTo(User::class),
            $this->belongsTo(Course::class, 'course_id'),
        ];
    }
}
