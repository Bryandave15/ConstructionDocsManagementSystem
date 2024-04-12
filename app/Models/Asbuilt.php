<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asbuilt extends Model
{
    use HasFactory;

    protected $table = 'asbuilt';
    protected $primaryKey = 'asbuilt_id';

    protected $fillable = [
        'asbuilt_title',
        'asbuilt_code',
        'asbuilt_location',
        'created_at',
        'updated_at',
        'trade',
        'attachment',
    ];

    protected $hidden = [
        'asbuilt_id',
    ]; 

}

