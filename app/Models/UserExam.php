<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_id',
        'status',
        'exam_join_status',
    ];
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
