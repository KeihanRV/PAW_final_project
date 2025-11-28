<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'content' => 'array',
        'tags' => 'array',
        'updated_at' => 'datetime',
        'journal_date' => 'date', 
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}