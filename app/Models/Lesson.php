<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'teacher_id',
        'classe_id',
        'matiere_id',
        'title',
        'sub_title',
        'body',
        'file_path',
        'is_publish'
    ];

    protected $casts = [
        'is_publish' => 'boolean',
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function parcours()
    {
        return $this->belongsToMany(Parcour::class);
    }
}
