<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['Subject_name', 'semester'];
    
    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }
}
