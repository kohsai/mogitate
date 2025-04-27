<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSeason extends Model
{
    use HasFactory;

    protected $table = 'product_season';
}

// ※
// Laravelの規約では、モデル名が「複数形」で、テーブル名も「複数形」である前提（例：Product → products）。

// でも、中間テーブルは特別で「単数_単数」(product_season)みたいな名前になりがち。

// その場合、Laravelに「このモデルは product_season テーブルを使うんだよ！」と教えてあげるために、$table を明示してる。
