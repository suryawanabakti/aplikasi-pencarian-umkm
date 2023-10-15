<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LokasiUmkm extends Model
{
    use HasFactory;
    public $table = 'lokasi_umkm';
    protected $guarded = ['id'];


    public function umkm()
    {
        return $this->belongsTo(DataUmkm::class, 'data_umkm_id', 'id');
    }
}
