<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Laporan_keuangan extends Model
{
    public $timestamps = false;
    protected $table   = "keuangan";
 
    protected $fillable = ['uuid_keuangan','tanggal','jenis','keterangan','nilai','saldo_akhir','id_unit'];
}