<?php

namespace App\Models;

use App\Models\ArtCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CollectionImages extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_id',
        'image',
        'imageDescription',
    ];

    public function artCollection() {
        return $this->belongsTo(ArtCollection::class);
    }

    protected $guarded = [];
}
