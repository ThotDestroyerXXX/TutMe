<?php

namespace App\Enums;

enum EnrollmentStatus: string
{
    case PENDING = 'PENDING';
    case ACTIVE = 'ACTIVE';
    case DONE = 'DONE';
}
