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

class Lesson extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'uuid',
        'matiere_id',
        'title_cour',
        'sub_title',
        'body',
        'file_path',
        'video_path',
        'is_publish',
        'dateFin',
        'year_university',
    ];

    protected function casts(): array
    {
        return [
            'dateFin' => 'datetime',
            'is_publish' => 'boolean',
        ];
    }

    public function exercices()
    {
        return $this->hasMany(Exercice::class);
    }

    public function sujets()
    {
        return $this->hasMany(Sujet::class);
    }

    public function getPhotoUrlAttribute()
    {
        return $this->getFirstMedia('cours_files')?->getUrl('cours_files');
    }

    public function getFileExtensionAttribute()
    {
        $media = $this->getFirstMedia('cours_files');
        return $media?->extension;
    }

    public function getFileSizeAttribute()
    {
        $media = $this->getFirstMedia('cours_files');
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


    public function registerMediaColections()
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

        // $this->addMediaConversion('pdf')
        //     ->fit(Fit::Fit, 1200, 1200)
        //     ->nonQueued()
        //     ->onlySource(File::PDF);

        // $this->addMediaConversion('office')
        //     ->fit(Fit::Fit, 1200, 1200)
        //     ->nonQueued()
        //     ->onlySource(File::WORD, File::POWERPOINT);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

}
