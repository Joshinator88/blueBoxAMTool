<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;

    protected $table = 'masters';

    protected $fillable = [
        'name', 'category_id', "user_id", "partner_id",
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    public function partners()
    {
        return $this->belongsToMany(Partner::class);
    }
}
