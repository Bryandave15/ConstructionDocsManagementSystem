<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inspection extends Model
{
    use HasFactory;

    protected $table = 'inspection';
    protected $primaryKey = 'inspection_id';

    protected $fillable = [
        'inspection_title',
        'inspection_code',
        'inspection_type',
        'inspection_category',
        'inspection_date',
        'description',
        'remarks',
        'attachment',
       
    ];

    protected $hidden = [
        'inspection_id',
    ]; 

}
