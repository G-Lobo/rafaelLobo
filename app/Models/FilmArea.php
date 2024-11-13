<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmArea extends Model
{
    use HasFactory;

    public function movie() {
        return $this->belongsTo(Movie::class);
    }

    protected $fillable = [
        'area',
    ];

    protected $guarded = [];
}
