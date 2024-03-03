<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari konvensi Laravel
    protected $table = 'siswa';

    // Tentukan field yang bisa diisi
    protected $fillable = ['name', 'email', 'school_id', 'class_id'];

    // Relasi ke model School
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // Relasi ke model Class
    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }
}
