<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function book() {
        return $this->belongsTo(
            Books::class
        );
    }
}
