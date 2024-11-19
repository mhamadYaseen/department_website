<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    protected $fillable = ['title', 'subject', 'lecturer', 'file_path'];
    
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
