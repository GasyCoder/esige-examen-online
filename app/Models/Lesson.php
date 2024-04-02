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
    use HasFactory, SoftDeletes;
    use InteractsWithMedia;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'uuid',
        'matiere_id',
        'title',
        'sub_title',
        'body',
        'file_path',
        'video_path',
        'is_publish'
    ];

    protected $casts = [
        'is_publish' => 'boolean',
    ];

    public function getPhotoUrlAttribute()
    {
        return $this->getFirstMedia('file_path') ? $this->getFirstMedia('file_path')->getUrl('preview') : null;
    }

    public function registerMediaColections()
    {
        $this->addMediaCollection('cours_files')
            ->acceptsFile(File::WORD)
            ->acceptsFile(File::POWERPOINT)
            ->acceptsFile(File::PDF);
        $this->addMediaCollection('downloads')
            ->singleFile();

    }
    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Crop, 300, 300)
            ->nonQueued();

        $this->addMediaConversion('pdf')
            ->fit(Fit::Fit, 1200, 1200)
            ->nonQueued()
            ->onlySource(File::PDF);

        $this->addMediaConversion('office')
            ->fit(Fit::Fit, 1200, 1200)
            ->nonQueued()
            ->onlySource(File::WORD, File::POWERPOINT);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

}
