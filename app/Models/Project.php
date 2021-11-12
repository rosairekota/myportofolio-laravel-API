<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Technology;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title','description','image_url'];

    public function technologies(){
        return $this->belongsToMany(Technology::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
