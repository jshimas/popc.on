<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeRating extends Model
{
    use HasFactory;

    public $table = 'age_rating';
    public $timestamps = false;
}
