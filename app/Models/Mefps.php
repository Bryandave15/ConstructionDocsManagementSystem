<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mefps extends Model
{
    use HasFactory;

    protected $table = 'mefps';
    protected $primaryKey = 'mefps_id';

    protected $fillable = [
        'mefps_title',
        'mefps_code',
        'mefps_location',
        'created_at',
        'updated_at',
        'trade',
        'attachment',
    ];

    protected $hidden = [
        'mefps_id',
    ]; 

}

