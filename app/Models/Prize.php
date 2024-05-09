<?php

namespace App\Models;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prize extends Model
{
    use HasFactory;

    public function movie() {
        return $this->belongsTo(Movie::class);
    }


    protected $guarded = [];
}
