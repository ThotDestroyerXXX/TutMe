<?php

namespace App\Enums;

enum EducationLevel: string
{
    case ELEMENTARY = 'Elementary';
    case MIDDLE_SCHOOL = 'Middle School';
    case HIGH_SCHOOL = 'High School';
    case BACHELOR = 'Bachelor';
    case MASTER = 'Master';
    case DOCTORATE = 'Doctorate';
    case OTHER = 'Other';
}
