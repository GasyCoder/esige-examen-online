<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    use HasFactory;

    protected $fillable = [
        'dateStart',
        'dateEnd',
        'note'
    ];

    protected function casts(): array
    {
        return [
            'dateStart' => 'datetime',
            'dateEnd' => 'datetime',
        ];
    }
}
