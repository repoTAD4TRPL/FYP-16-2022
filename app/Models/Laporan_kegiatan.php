<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Laporan_kegiatan extends Model
{
    public $timestamps = false;
    protected $table = "laporan_kegiatan";
 
    protected $fillable = ['uuid_kegiatan','tanggal','id_unit','keterangan','lokasi'];
}