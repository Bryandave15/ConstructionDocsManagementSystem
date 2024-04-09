<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Structural extends Model
{
    use HasFactory;

    protected $table = 'structural';
    protected $primaryKey = 'structural_id';

    protected $fillable = [
        'structural_title',
        'structural_code',
        'location',
        'created_at',
        'updated_at',
        'trade',
        'attachment',
    ];

    protected $hidden = [
        'structural_id',
    ]; 

}
