<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    use HasFactory;
    protected $fillable=['name','image_url'];

    public function projects(){
        return $this->belongsToMany(Project::class);
    }
}
