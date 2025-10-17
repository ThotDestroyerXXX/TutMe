<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case TUTOR = 'Tutor';
    case STUDENT = 'Tutee';
    case DONATOR = 'Donator';
}
