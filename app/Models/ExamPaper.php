<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamPaper extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'subject_id', 'file_path'];

    // Relationship to Subject
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
