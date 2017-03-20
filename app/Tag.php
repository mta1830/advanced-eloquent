<?php

namespace AdvancedELOQUENT;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['title'];

    public function videos(){
        $this->morphToMany(Video::class,'taggable');
    }

    public function posts(){
        $this->morphToMany(Post::class,'taggable');
    }
}
