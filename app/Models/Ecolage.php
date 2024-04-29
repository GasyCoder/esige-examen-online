<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ecolage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'user_id',
        'received',
        'motif',
        'mode',
        'reference',
        'datePay',
        'mois_restants',
        'tranche',
        'amount',
        'status',
        'file_joint'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            $model->reference = $model->generateUniqueReference();
        });
    }

    protected function casts(): array
    {
        return [
            'datePay' => 'datetime',
        ];
    }

    public function generateUniqueReference()
    {
        // Generate a unique number
        $uniqueNumber = mt_rand(100, 9999);

        // Check if the number already exists in the 'reference' column
        while (self::where('reference', $uniqueNumber)->exists()) {
            // If the number exists, generate a new one
            $uniqueNumber = mt_rand(100, 9999);
        }

        return $uniqueNumber;
    }
}
