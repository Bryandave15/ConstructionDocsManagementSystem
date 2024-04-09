<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    use HasFactory;

    protected $table = 'directory';
    protected $primaryKey = 'directory_id';

    protected $fillable = [
        'fullname',
        'jobtitle',
        'email',
        'phone_number',
        'address',
        'company',
       
    ];

    protected $hidden = [
        'directory_id',
    ]; 

}
