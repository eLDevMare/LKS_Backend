<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Enrollments extends Model
{
    use HasFactory;
    protected $table = 'enrollments';
    protected $fillable =  [
        'users_id',
        'course_id',
    ];
}
