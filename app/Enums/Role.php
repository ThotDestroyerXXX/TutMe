<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case TUTOR = 'Mentor';
    case STUDENT = 'Tutee';
    case DONATOR = 'Donator';
}
