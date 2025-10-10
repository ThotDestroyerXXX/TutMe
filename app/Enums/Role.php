<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case TUTOR = 'Tutor';
    case STUDENT = 'Student';
    case DONATOR = 'Donator';
}
