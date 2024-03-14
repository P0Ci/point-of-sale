<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';
    protected $guarded = [];
    protected $primaryKey = 'id_member';

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['member'] ?? false, function($query, $search) {
            return $query->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('kode_member', 'like', '%' . $search . '%');
        });
    }

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }
}
