<?php

namespace App\App\models;

use App\config\Model;
use App\config\App;

class Internship extends Model
{

    public $fillable = [
        'timestamp',
        'name',
        'website',
        'address',
        'paid',
        'techStack',
        'duration',
        'appliedVia',
        'recruitmentProcess',
        'examDetails',
        'extraAdvice',
        'project',
        'realProject',
        'schedule',
        'mentorship',
        'environment',
        'certificate',
        'suggestion',
        'fullTimePossibility',
    ];

    public static function tableName(): string
    {
        return "internships";
    }
    

    
}
