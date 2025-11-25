<?php

namespace App\Enums;

enum EnrollmentStatus: string
{
    case PENDING = 'PENDING';
    case ACTIVE = 'ACTIVE';
    case REJECTED = 'REJECTED';
    case DONE = 'DONE';
}
