<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeSujet extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'label',
    ];

    public function typeSujet()
    {
        return $this->belongsTo(TypeSujet::class);
    }
}
