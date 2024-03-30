<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sujet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'matiere_id',
        'observations',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
