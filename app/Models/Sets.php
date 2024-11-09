<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sets extends Model
{
    use HasFactory;

    protected $table = 'sets';
    protected $fillable = [
        'name',
        'order',
        'course_id'
    ];

    public function courses()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
