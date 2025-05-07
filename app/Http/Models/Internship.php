<?php

namespace App\app\Http\Models;

use App\config\Model;
use App\config\App;

class Internship extends Model
{

    public static $table = 'companies';
    public array  $fillable = [
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

    // public static function table()
    // {
    //     return 'internship';
    // }
    

    
}
