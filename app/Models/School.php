<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';

    // Specify which column values can be mass assigned
    protected $fillable = ['school_name', 'address'];

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }
}
