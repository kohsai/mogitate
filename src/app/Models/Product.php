<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // 一括代入の許可カラム
    protected $fillable = ['name', 'price', 'description', 'image'];

    // Seasonとのリレーション（多対多）
    public function seasons()
    {
        return $this->belongsToMany(Season::class);
    }
}
