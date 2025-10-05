<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collage extends Model
{
    use HasFactory;

    public function collection() {
        return $this->hasMany(Collection::class);
    }

    protected $fillable = [
        'title',
        'content',
        'releaseDate',
    ];

    protected $guarded=[];
}
