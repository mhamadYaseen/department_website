<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $fillable=['semester_number'];
   
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }
    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }
}
