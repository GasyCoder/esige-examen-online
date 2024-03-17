<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcour extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "sigle",
    ];

    public function matieres()
    {
        return $this->belongsToMany(Matiere::class);
    }

    public function lessons()
    {
        return $this->belongsToMany(Lesson::class);
    }

}
