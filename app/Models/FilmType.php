<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilmType extends Model
{
    use HasFactory;

    public function movie() {
        return $this->BelongsTo(Movie::class);
    }


    protected $guarded = [];
}