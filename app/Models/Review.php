<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = 'reviews';
    public $timestamps = false;
    protected $fillable = ['rating', 'comment', 'type', 'created_at', 'movie_fk', 'showtime_fk', 'user_fk'];
}
