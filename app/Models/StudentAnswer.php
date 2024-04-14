<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\Image\Enums\Fit;
use Livewire\Attributes\Validate;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class StudentAnswer extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;
    protected $appends = ['time_diff'];
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'uuid',
        'sujet_id',
        'question_id',
        'student_id',
        'answers',
        'is_correct',
        'file_path',
        'reponse_textarea',
        'reponse_text_image',
        'reference',
        'answered_at',
        'open',
        'student_ip',
        'student_user_agent',
        'year_university',
    ];

    public function sujet()
    {
        return $this->belongsTo(Sujet::class, 'sujet_id');
    }

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }

    protected function casts(): array
    {
        return [
            'answered_at' => 'datetime',
            'dateFin' => 'datetime',
        ];
    }

    public function getTimeDiffAttribute()
    {
        // Calculer la différence de temps entre la date de création et maintenant
        return Carbon::parse($this->answered_at)->diffForHumans();
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }



    public function getPhotoUrlAttribute()
    {
        return $this->getFirstMedia('reponse_examen_files')?->getUrl('reponse_examen_files');
    }

    public function getFileExtensionAttribute()
    {
        $media = $this->getFirstMedia('reponse_examen_files');
        return $media?->extension;
    }

    public function getFileSizeAttribute()
    {
        $media = $this->getFirstMedia('reponse_examen_files');
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
        $this->addMediaCollection('reponse_examen_files')
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



}
