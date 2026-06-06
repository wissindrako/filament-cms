<?php

namespace App\Filament\Resources;

use App\Enums\ContentStatus;
use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;
    protected static ?string $navigationIcon = 'heroicon-o-code-bracket';
    protected static ?string $navigationGroup = 'Contenido';
    protected static ?string $modelLabel = 'Servicio';
    protected static ?string $pluralModelLabel = 'Servicios';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Información principal')->columns(2)->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Título')->required()->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, Forms\Set $set) => $set('slug', Str::slug($state))),

                Forms\Components\TextInput::make('slug')
                    ->label('Slug')->required()->unique(ignoreRecord: true)->maxLength(255),

                Forms\Components\TextInput::make('icon')
                    ->label('Ícono (Heroicon)')->placeholder('heroicon-o-code-bracket')
                    ->required()->columnSpan(2),

                Forms\Components\TextInput::make('short_description')
                    ->label('Descripción corta')->required()->maxLength(255)->columnSpan(2),

                Forms\Components\RichEditor::make('description')
                    ->label('Descripción completa')->required()->columnSpan(2),
            ]),

            Forms\Components\Section::make('Características')->schema([
                Forms\Components\Repeater::make('features')->label('Características')
                    ->schema([
                        Forms\Components\TextInput::make('feature')->label('Característica')->required(),
                    ])
                    ->addActionLabel('Agregar característica')->reorderable()->collapsible(),
            ]),

            Forms\Components\Section::make('Imagen de portada')->schema([
                Forms\Components\SpatieMediaLibraryFileUpload::make('cover')
                    ->label('Imagen')->collection('cover')->image()
                    ->imageResizeMode('cover')->imageCropAspectRatio('16:9'),
            ]),

            Forms\Components\Section::make('Publicación')->columns(2)->schema([
                Forms\Components\TextInput::make('order')->label('Orden')->numeric()->default(0),

                Forms\Components\Select::make('status')->label('Estado')
                    ->options(ContentStatus::class)->default(ContentStatus::Draft)->required()
                    ->disabled(fn () => ! auth()->user()?->hasAnyRole(['admin', 'approver'])),

                Forms\Components\DateTimePicker::make('published_at')
                    ->label('Fecha de publicación')->columnSpan(2),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')->label('#')->sortable()->width(50),
                Tables\Columns\TextColumn::make('title')->label('Título')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('short_description')->label('Descripción')->limit(50)->toggleable(),
                Tables\Columns\TextColumn::make('status')->label('Estado')->badge()->sortable(),
                Tables\Columns\TextColumn::make('creator.name')->label('Creado por')->toggleable(),
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
            ->visible(fn (Service $r) =>
                $r->status === ContentStatus::Draft &&
                auth()->user()?->hasAnyRole(['admin', 'editor'])
            )
            ->action(function (Service $record) {
                $record->update(['status' => ContentStatus::PendingReview]);
                Notification::make()->title('Enviado a revisión')->success()->send();
            });
    }

    private static function approveAction(): Tables\Actions\Action
    {
        return Tables\Actions\Action::make('approve')
            ->label('Aprobar')->icon('heroicon-o-check-circle')->color('success')
            ->visible(fn (Service $r) =>
                $r->status === ContentStatus::PendingReview &&
                auth()->user()?->hasAnyRole(['admin', 'approver'])
            )
            ->action(function (Service $record) {
                $record->update(['status' => ContentStatus::Approved, 'approved_by' => auth()->id()]);
                Notification::make()->title('Aprobado')->success()->send();
            });
    }

    private static function publishAction(): Tables\Actions\Action
    {
        return Tables\Actions\Action::make('publish')
            ->label('Publicar')->icon('heroicon-o-globe-alt')->color('info')
            ->visible(fn (Service $r) =>
                $r->status === ContentStatus::Approved &&
                auth()->user()?->hasAnyRole(['admin', 'approver'])
            )
            ->action(function (Service $record) {
                $record->update(['status' => ContentStatus::Published, 'published_at' => now()]);
                Notification::make()->title('Publicado')->success()->send();
            });
    }

    private static function rejectAction(): Tables\Actions\Action
    {
        return Tables\Actions\Action::make('reject')
            ->label('Rechazar')->icon('heroicon-o-x-circle')->color('danger')
            ->visible(fn (Service $r) =>
                $r->status === ContentStatus::PendingReview &&
                auth()->user()?->hasAnyRole(['admin', 'approver'])
            )
            ->action(function (Service $record) {
                $record->update(['status' => ContentStatus::Rejected]);
                Notification::make()->title('Rechazado')->warning()->send();
            });
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit'   => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
