<?php

namespace App\Filament\Resources;

use App\Enums\ContentStatus;
use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Contenido';
    protected static ?string $modelLabel = 'Testimonio';
    protected static ?string $pluralModelLabel = 'Testimonios';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Información del autor')->columns(2)->schema([
                Forms\Components\TextInput::make('author_name')
                    ->label('Nombre')->required()->maxLength(255),
                Forms\Components\TextInput::make('author_role')
                    ->label('Cargo')->maxLength(255),
                Forms\Components\TextInput::make('company')
                    ->label('Empresa')->maxLength(255),
                Forms\Components\Select::make('rating')->label('Calificación')
                    ->options([1 => '★', 2 => '★★', 3 => '★★★', 4 => '★★★★', 5 => '★★★★★'])
                    ->default(5)->required(),
            ]),

            Forms\Components\Section::make('Testimonio')->schema([
                Forms\Components\Textarea::make('content')
                    ->label('Comentario')->required()->rows(4),
            ]),

            Forms\Components\Section::make('Avatar')->schema([
                Forms\Components\SpatieMediaLibraryFileUpload::make('avatar')
                    ->label('Foto del autor')->collection('avatar')->image()->avatar(),
            ]),

            Forms\Components\Section::make('Publicación')->columns(2)->schema([
                Forms\Components\TextInput::make('order')->label('Orden')->numeric()->default(0),
                Forms\Components\Select::make('status')->label('Estado')
                    ->options(ContentStatus::class)->default(ContentStatus::Draft)->required()
                    ->disabled(fn () => ! auth()->user()?->hasAnyRole(['admin', 'approver'])),
                Forms\Components\DateTimePicker::make('published_at')->label('Fecha de publicación'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('author_name')->label('Autor')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('company')->label('Empresa')->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('rating')->label('★')
                    ->formatStateUsing(fn ($state) => str_repeat('★', $state)),
                Tables\Columns\TextColumn::make('content')->label('Comentario')->limit(60),
                Tables\Columns\TextColumn::make('status')->label('Estado')->badge()->sortable(),
                Tables\Columns\TextColumn::make('published_at')->label('Publicado')->dateTime('d/m/Y')->sortable()->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->label('Estado')->options(ContentStatus::class),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                self::submitReviewAction(),
                self::approveAction(),
                self::publishAction(),
                self::rejectAction(),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => auth()->user()?->hasRole('admin')),
            ])
            ->defaultSort('order');
    }

    private static function submitReviewAction(): Tables\Actions\Action
    {
        return Tables\Actions\Action::make('submit_review')
            ->label('Enviar a revisión')->icon('heroicon-o-paper-airplane')->color('warning')
            ->visible(fn (Testimonial $r) =>
                $r->status === ContentStatus::Draft &&
                auth()->user()?->hasAnyRole(['admin', 'editor'])
            )
            ->action(function (Testimonial $record) {
                $record->update(['status' => ContentStatus::PendingReview]);
                Notification::make()->title('Enviado a revisión')->success()->send();
            });
    }

    private static function approveAction(): Tables\Actions\Action
    {
        return Tables\Actions\Action::make('approve')
            ->label('Aprobar')->icon('heroicon-o-check-circle')->color('success')
            ->visible(fn (Testimonial $r) =>
                $r->status === ContentStatus::PendingReview &&
                auth()->user()?->hasAnyRole(['admin', 'approver'])
            )
            ->action(function (Testimonial $record) {
                $record->update(['status' => ContentStatus::Approved, 'approved_by' => auth()->id()]);
                Notification::make()->title('Aprobado')->success()->send();
            });
    }

    private static function publishAction(): Tables\Actions\Action
    {
        return Tables\Actions\Action::make('publish')
            ->label('Publicar')->icon('heroicon-o-globe-alt')->color('info')
            ->visible(fn (Testimonial $r) =>
                $r->status === ContentStatus::Approved &&
                auth()->user()?->hasAnyRole(['admin', 'approver'])
            )
            ->action(function (Testimonial $record) {
                $record->update(['status' => ContentStatus::Published, 'published_at' => now()]);
                Notification::make()->title('Publicado')->success()->send();
            });
    }

    private static function rejectAction(): Tables\Actions\Action
    {
        return Tables\Actions\Action::make('reject')
            ->label('Rechazar')->icon('heroicon-o-x-circle')->color('danger')
            ->visible(fn (Testimonial $r) =>
                $r->status === ContentStatus::PendingReview &&
                auth()->user()?->hasAnyRole(['admin', 'approver'])
            )
            ->action(function (Testimonial $record) {
                $record->update(['status' => ContentStatus::Rejected]);
                Notification::make()->title('Rechazado')->warning()->send();
            });
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit'   => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }
}
