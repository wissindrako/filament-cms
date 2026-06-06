<?php

namespace App\Models;

use App\Enums\ContentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Project extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title', 'slug', 'short_description', 'description',
        'tech_stack', 'client', 'url', 'featured',
        'order', 'status', 'published_at', 'created_by', 'approved_by',
    ];

    protected $casts = [
        'tech_stack'   => 'array',
        'featured'     => 'boolean',
        'status'       => ContentStatus::class,
        'published_at' => 'datetime',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
        $this->addMediaCollection('gallery');
    }

    public function scopePublished($query)
    {
        return $query->where('status', ContentStatus::Published)->orderBy('order');
    }
}
