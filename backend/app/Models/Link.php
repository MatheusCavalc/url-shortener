<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'destination',
        'title',
        'back_half'
    ];


    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
