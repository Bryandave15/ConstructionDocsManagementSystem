<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $table = 'meeting';
    protected $primaryKey = 'meeting_id';

    protected $fillable = [
        'meeting_title',
        'meeting_overview',
        'meeting_location',
        'meeting_agenda',
        'minutes_meeting',
        'created_at',
        'updated_at',
        'attachment',
    ];

    protected $hidden = [
        'meeting_id',
    ]; 

}
