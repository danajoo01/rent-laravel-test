<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'movie';
    protected $fillable = ['judul', 'movie_id', 'studio', 'filmby', 'tahun', 'stok', 'lokasi', 'deskripsi', 'cover'];

    /**
     * Method One To Many 
     */
    public function transaksi()
    {
    	return $this->hasMany(Transaksi::class);
    }
}
