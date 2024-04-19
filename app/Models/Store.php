<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'address', 'active', 'image_url'];

    public function books() {
        return $this->belongsToMany(Book::class, 'book_store', 'store_id', 'book_id');
    }
}
