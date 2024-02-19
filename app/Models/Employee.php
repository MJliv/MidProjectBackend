<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'umur',
        'alamat',
        'mobile'
    ];

    protected $table = 'employee';
    public $timestamps = false;
}
