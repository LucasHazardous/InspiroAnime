<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspiration extends Model
{
    use HasFactory;

    protected $fillable = [
        'creator',
        'image',
        'text',
        'source'
    ];
}
