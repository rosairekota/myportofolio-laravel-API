<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $fillable =
    ['firstname',
    'lastname',
    'middlename',
    'description',
    'github_link',
    'linkedin_link',
    'twitter_link',
    'email',
    'phone',
    'address'
    ];
}
