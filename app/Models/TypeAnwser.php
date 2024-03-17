<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAnwser extends Model
{
    use HasFactory;

    protected $fillable = [
        'types',
        'label',
    ];
}
