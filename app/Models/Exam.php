<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'title',
        'exam_date',
        'exam_duration',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
