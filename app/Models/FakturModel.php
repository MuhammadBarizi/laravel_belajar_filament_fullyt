<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FakturModel extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $table = 'faktur';

    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(CustomerModel::class);
    } 

    public function detail()
    {
        return $this->hasMany(DetailFakturModel::class, 'faktur_id');
    }

    public function penjualan()
    {
        return $this->hasMany(PenjualanModel::class, 'faktur_id');
    }

}
