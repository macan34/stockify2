<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'supplier_id',
        'stock',
        'price',
        'image',
        'status',
    ];

    /**
     * Relasi ke kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Relasi ke transaksi stok
     */
    public function transactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

        public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }
}


