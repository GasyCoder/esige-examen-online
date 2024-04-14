<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_app',
        'is_disabled',
        'message_disabled',
        'banner',
        'logo',
        'year_period',
    ];
}
