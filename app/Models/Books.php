<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function author() {
        return $this->belongsTo(
            Authors::class
        );
    }

    public function category() {
        return $this->belongsTo(
            Categories::class
        );
    }

    public function scopeFilter($query, array $filters) {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                 $query->where('title', 'like', '%' . $search . '%')
                       ->orWhere('body', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['category'] ?? false, function($query, $category) { 
            return $query->whereHas("category", function($query) use ($category) {
                $query->where('name',$category);
            });
        });

        $query->when($filters['author'] ?? false, function($query, $author) { 
            return $query->whereHas("author", function($query) use ($author) {
                $query->where('slug',$author);
            });
        });
    }
}
