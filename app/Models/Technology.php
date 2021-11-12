<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Technology extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable=['name','icon'];

    public function projects(){
        return $this->belongsToMany(Project::class);
    }
}
