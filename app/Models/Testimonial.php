<?php

namespace App\Models;

use App\Enums\ContentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Testimonial extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'author_name', 'author_role', 'company', 'content',
        'rating', 'order', 'status', 'published_at',
        'created_by', 'approved_by',
    ];

    protected $casts = [
        'rating'       => 'integer',
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
        $this->addMediaCollection('avatar')->singleFile();
    }

    public function scopePublished($query)
    {
        return $query->where('status', ContentStatus::Published)->orderBy('order');
    }
}
