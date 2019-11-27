<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['kode_transaksi', 'anggota_id', 'film_id', 'tgl_pinjam', 'tgl_kembali', 'status', 'ket'];

    public function anggota()
    {
    	return $this->belongsTo(Anggota::class);
    }

    public function film()
    {
    	return $this->belongsTo(Film::class);
    }
}
