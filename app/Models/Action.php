<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    public function who()
    {
        return $this->belongsTo(User::class, 'id', 'who');
    }
    public function support()
    {
        return $this->belongsTo(User::class, 'id', 'support');
    }
}
