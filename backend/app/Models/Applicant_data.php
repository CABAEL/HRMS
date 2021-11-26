<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant_data extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_profile_id',
        'resume_link',
        'educational_background',
        'status',
    ];

    protected $hidden = [
        'id',
        'user_profile_id',
    ];
}
