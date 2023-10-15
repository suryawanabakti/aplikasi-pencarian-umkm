<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUmkm extends Model
{
    use HasFactory;
    public $table = 'data_umkm';
    protected $guarded = ['id'];

    public function penilaian()
    {
        return $this->hasMany(PenilaianUmkm::class);
    }
}
