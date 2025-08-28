<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;

    protected $table = 'stock_transactions';
    protected $fillable = [
    'product_id',
    'quantity',
    'type',
    'user_id',
    'note',
    'status',      // sudah ada di DB
    'checked_by',  // sudah ada di DB
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
