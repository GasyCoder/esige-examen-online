<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sujet_id',
        'type',
        'label',
        'options',
        'question_texte',
        'file_path',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];


    public function sujet()
    {
        return $this->belongsTo(Sujet::class);
    }
}
