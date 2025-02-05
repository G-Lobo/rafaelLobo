<?php

namespace App\Models;

use App\Models\Prize;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    public function prizes() {
        return $this->hasMany(Prize::class);
    }

    public function filmType() {
        return $this->belongsTo(FilmType::class);
    }

    public function filmAreas() {
        return $this->belongsToMany(FilmArea::class, 'movie_film_areas');
    }

    protected $fillable = [
        'title',
        'releaseDate',
        'content',
        'coverArt',
        'link',
        'videoLink',
        'duration',
        'typeId',

    ];


    protected $guarded = [];
}
