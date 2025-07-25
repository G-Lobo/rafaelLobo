<?php

namespace App\Models;

use App\Models\Prize;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'releaseDate',
        'content',
        'coverArt',
        'link',
        'videoLink',
        'duration',
        'typeId',
        'collage_images', // Adicionado para permitir a atribuição em massa
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'releaseDate' => 'date',
        'collage_images' => 'array', // Adicionado para tratar a coluna JSON como um array
    ];

    public function prizes()
    {
        return $this->hasMany(Prize::class);
    }

    public function filmType()
    {
        return $this->belongsTo(FilmType::class);
    }

    public function filmAreas()
    {
        return $this->belongsToMany(FilmArea::class, 'movie_film_areas');
    }

    // A propriedade $guarded vazia já permite a atribuição em massa,
    // mas é uma boa prática ser explícito com $fillable.
    // protected $guarded = [];
}
