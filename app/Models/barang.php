<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    //
    protected $guarded = [];

    protected $table = 'barangs';

    public function detail() {

        return $this->hasMany(DetailFakturModel::class);
        
    }
}
