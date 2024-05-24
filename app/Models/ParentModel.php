<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;

    protected $table = 'parents';

    protected $fillable = [
        'name', 'category_id', 'partners', 'sales_support', 'sales_administrator',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}

