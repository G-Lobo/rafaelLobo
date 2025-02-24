<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArtCollection extends Model
{
    use HasFactory;

    public function images() {
        return $this->hasMany(CollectionImages::class);
    }

    protected $fillable = [
        'collectionName',
        'collectionDescription',
        'link',
    ];

    protected $guarded = [];

}
