<?php

namespace App\Models;

use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\Support\File;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Question extends Model implements HasMedia
{
    use HasFactory, SoftDeletes;
    use InteractsWithMedia;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'sujet_id',
        'generalQuestion',
        'chooseResponse',
        'correctResponse',
        'pointResponse',

        'typeQuestion',

        'question_texte',
        'image_required',
        'file_path',
        'comment',
    ];

    public function typeSujet()
    {
        return $this->belongsTo(TypeSujet::class);
    }

    public function sujet()
    {
        return $this->belongsTo(Sujet::class);
    }

    // public function getFilePathAttribute()
    // {
    //     return $this->getFirstMediaUrl('sujet_examen_files');
    // }

    public function getPhotoUrlAttribute()
    {
        return $this->getFirstMedia('sujet_examen_files')?->getUrl('sujet_examen_files');
    }

    public function getFileExtensionAttribute()
    {
        $media = $this->getFirstMedia('sujet_examen_files');
        return $media?->extension;
    }

    public function getFileSizeAttribute()
    {
        $media = $this->getFirstMedia('sujet_examen_files');
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
        $this->addMediaCollection('sujet_examen_files')
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
}
