<?php

namespace AdvancedELOQUENT;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //relacion hasMany
    public function books(){
        return $this->hasMany(Book::class);
    }

    public function getNumBooksAttribute(){
        return count($this->books);
    }

    public function getNumPublicBooksAttribute(){
        return count($this->books->where('status','public'));
    }

    public function getPublicBooksAttribute(){
        return $this->books->where('status','public');
    }
}
