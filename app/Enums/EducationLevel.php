<?php

namespace App\Enums;

enum EducationLevel: string
{
    case ELEMENTARY = 'elementary';
    case MIDDLE_SCHOOL = 'middle_school';
    case HIGH_SCHOOL = 'high_school';
    case UNIVERSITY = 'university';
    case OTHER = 'other';
}
