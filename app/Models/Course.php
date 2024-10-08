<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory,SoftDeletes;

    protected $guarded = [
        'id'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
        
    }

    public function quetions(){
        return $this->hasMany(CourseQuetion::class,'course_id','id');
    }

    public function students(){
        return $this->hasMany(CourseQuetion::class,'course_students','user_id','course_id');
    }
}
