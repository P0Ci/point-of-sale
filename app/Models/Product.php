<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = [];
    protected $primaryKey = 'id_product';

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['product'] ?? false, function ($query, $search) {
            return $query->where('nama_product', 'like', '%' . $search . '%')
                ->orWhere('kode_product', 'like', '%' . $search . '%');
        });
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'id_categories');
    }
}
