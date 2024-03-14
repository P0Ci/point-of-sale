<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualan';
    protected $guarded = [];
    protected $primaryKey = 'id_penjualan';
    protected $with = ['member'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['member'] ?? false, function ($query, $member) {
            $query->whereHas('member', function ($query) use ($member) {
                $query->where('nama', 'like', '%'.$member.'%')
                ->orWhere('kode_member', 'like', '%'.$member.'%');
            });
        });
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member');
    }
}
