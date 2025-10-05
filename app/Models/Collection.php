<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    public function collage() {
        return $this->belongsTo(Collage::class);
    }

    protected $guarded=[];
}
