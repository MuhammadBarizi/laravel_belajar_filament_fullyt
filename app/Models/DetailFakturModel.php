<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailFakturModel extends Model
{
    //
    use HasFactory;

    protected $table = 'detail';
    
    protected $fillable = [
        'barang_id',
        'faktur_id',
        'qty',
        'subtotal',
        'diskon',
        'nama_barang',
        'harga',
        'hasil_qty'
    ];

    public function barang()
    {
        return $this->belongsTo(barang::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($detail) {
            if (!$detail->subtotal) {
                $detail->subtotal = ($detail->harga * $detail->qty) - $detail->diskon;
            }
        });
        
        static::updating(function ($detail) {
            if ($detail->isDirty(['harga', 'qty', 'diskon'])) {
                $detail->subtotal = ($detail->harga * $detail->qty) - $detail->diskon;
            }
        });
    }

    public function faktur()
    {
        return $this->belongsTo(FakturModel::class, 'id');
    }

 

}
