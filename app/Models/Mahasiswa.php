<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model {
    protected $table = 'table_mahasiswa';
    protected $fillable = ['nama', 'nim', 'jurusan'];
}
