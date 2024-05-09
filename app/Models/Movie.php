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



    protected $fillable = [
        'title',
        'releaseDate',
        'content',
        'coverArt',
        'link',
        'videoLink',
        'duration',
    ];


    protected $guarded = [];
}
