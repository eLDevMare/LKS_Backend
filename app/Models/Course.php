<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $table = 'course';

    public function users()
    {
        return $this->belongsToMany(User::class, 'enrollments' ,'course_id', 'users_id');
    }

    public function sets()
    {
        return $this->hasMany(Sets::class, 'course_id');
    }
}
