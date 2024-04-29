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
        'exam_session',
        'year_period',
        'conditions',
    ];

    protected function casts(): array
    {
        return [
            'is_disabled' => 'boolean',
        ];
    }
}
