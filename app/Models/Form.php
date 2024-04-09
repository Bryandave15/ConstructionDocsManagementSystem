<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $table = 'form';
    protected $primaryKey = 'form_id';

    protected $fillable = [
        'form_title',
        'form_type',
        'description',
        'attachment',
       
    ];

    protected $hidden = [
        'report_id',
    ]; 

}
