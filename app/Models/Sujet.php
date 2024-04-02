<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sujet extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'matiere_id',
        'reference',
        'timer',
        'isActive',
        'uuid',
        'dateFin',
        'type_sujet_id'
    ];

    protected $casts = [
        'isActive' => 'boolean',
        'dateFin' => 'datetime',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function typeSujet()
    {
        return $this->belongsTo(TypeSujet::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            $model->reference = $model->generateUniqueReference();
        });
    }

    public function generateUniqueReference()
    {
        // Generate a unique number
        $uniqueNumber = mt_rand(100, 999);

        // Check if the number already exists in the 'reference' column
        while (self::where('reference', $uniqueNumber)->exists()) {
            // If the number exists, generate a new one
            $uniqueNumber = mt_rand(100, 999);
        }

        return $uniqueNumber;
    }

    public function getFormattedTimerAttribute()
    {
        $hours = floor($this->timer / 60);
        $minutes = $this->timer % 60;
        return sprintf("%02d:%02d", $hours, $minutes);
    }
}
