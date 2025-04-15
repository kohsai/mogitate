<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    // 一括代入の許可カラム（Seederやフォームから保存するために必要）
    protected $fillable = ['name'];

    // Productとのリレーション（多対多）
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
