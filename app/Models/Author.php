<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = ['firstname', 'lastname'];
    public $timestamps = true;

    public function fullName()
    {
        return $this->firstname . " " . $this->lastname;
    }

    public function book()
    {
        return $this->hasMany('App\Models\Book', 'author_id');
    }

}

