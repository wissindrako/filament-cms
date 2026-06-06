<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ContentStatus: string implements HasColor, HasIcon, HasLabel
{
    case Draft          = 'draft';
    case PendingReview  = 'pending_review';
    case Approved       = 'approved';
    case Rejected       = 'rejected';
    case Published      = 'published';

    public function getLabel(): string
    {
        return match($this) {
            self::Draft         => 'Borrador',
            self::PendingReview => 'En revisión',
            self::Approved      => 'Aprobado',
            self::Rejected      => 'Rechazado',
            self::Published     => 'Publicado',
        };
    }

    public function getColor(): string
    {
        return match($this) {
            self::Draft         => 'gray',
            self::PendingReview => 'warning',
            self::Approved      => 'info',
            self::Rejected      => 'danger',
            self::Published     => 'success',
        };
    }

    public function getIcon(): string
    {
        return match($this) {
            self::Draft         => 'heroicon-o-pencil',
            self::PendingReview => 'heroicon-o-clock',
            self::Approved      => 'heroicon-o-check-circle',
            self::Rejected      => 'heroicon-o-x-circle',
            self::Published     => 'heroicon-o-globe-alt',
        };
    }
}
