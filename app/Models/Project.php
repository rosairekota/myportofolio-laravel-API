<?php

namespace App\Models;

use App\Models\Technology;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable=['title','description','image_url'];

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }
}
