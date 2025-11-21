<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postcard extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'continent', 'city', 'country', 'description', 'image'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}