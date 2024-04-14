<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\Support\File;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Exercice extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'lesson_id',
        'file_path',
        'dateFin',
        'status',
        'reference',
        'year_university',
    ];

    protected function casts(): array
    {
        return [
            'dateFin' => 'datetime',
        ];
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }


    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function answers()
    {
        return $this->hasMany(AnswerExercice::class);
    }

    public function getPhotoUrlAttribute()
    {
        return $this->getFirstMedia('exercice_files')?->getUrl('exercice_files');
    }

    public function getFileExtensionAttribute()
    {
        $media = $this->getFirstMedia('exercice_files');
        return $media?->extension;
    }

    public function getFileSizeAttribute()
    {
        $media = $this->getFirstMedia('exercice_files');
        return $media ? $this->formatBytes($media->size) : null;
    }

    protected function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('exercice_files')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation']);

        $this->addMediaCollection('downloads')
            ->singleFile();
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Crop, 300, 300)
            ->nonQueued();
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
        $uniqueNumber = mt_rand(1000, 9999);

        // Check if the number already exists in the 'reference' column
        while (self::where('reference', $uniqueNumber)->exists()) {
            // If the number exists, generate a new one
            $uniqueNumber = mt_rand(100, 999);
        }

        return $uniqueNumber;
    }
}
