<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Architectural extends Model
{
    use HasFactory;

    protected $table = 'architectural';
    protected $primaryKey = 'architectural_id';

    protected $fillable = [
        'architectural_title',
        'architectural_code',
        'architectural_location',
        'created_at',
        'updated_at',
        'trade',
        'attachment',
    ];

    protected $hidden = [
        'architectural_id',
    ]; 

}

