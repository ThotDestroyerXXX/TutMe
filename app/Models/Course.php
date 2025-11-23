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
        'level',
        'subject',
        'title',
        'session',
        'image',
        'instructor_id',
        'topics',
        'start_time',
        'end_time',
        'meet_link',
        'day',
    ];

    protected $casts = [
        'topics' => 'array',
        'day' => 'array',
    ];

    public function Course(){
        return $this->hasManyThrough(
        Course::class,
        Enrollment::class,
        'user_id',
        'course_id',
        'id',
        'course_id'
    );
    }
}
