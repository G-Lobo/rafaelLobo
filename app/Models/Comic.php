<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;

    public function pages(){
        return $this->hasMany(Page::class);
    }

    protected  $fillable = [
        "title",
        "content",
        "link",
        "coverImg",
        "releaseDate",
        "moviePoster",
    ];

    protected $guarded = [];
}
