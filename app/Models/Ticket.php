<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';
    public $timestamps = false;
    protected $fillable = ['quantity', 'showtime_fk', 'user_fk', 'order_date'];
}
