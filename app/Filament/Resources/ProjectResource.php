<?php

namespace App\Filament\Resources;

use App\Enums\ContentStatus;
use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static ?string $navigationGroup = 'Contenido';
    protected static ?string $modelLabel = 'Proyecto';
    protected static ?string $pluralModelLabel = 'Proyectos';
    protected static ?int $navigationSort = 2;

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

                Forms\Components\TextInput::make('short_description')
                    ->label('Descripción corta')->required()->maxLength(255)->columnSpan(2),

                Forms\Components\RichEditor::make('description')
                    ->label('Descripción completa')->required()->columnSpan(2),

                Forms\Components\TextInput::make('client')->label('Cliente')->maxLength(255),
                Forms\Components\TextInput::make('url')->label('URL del proyecto')->url()->maxLength(255),
            ]),

            Forms\Components\Section::make('Stack tecnológico')->schema([
                Forms\Components\Repeater::make('tech_stack')->label('Tecnologías')
                    ->schema([
                        Forms\Components\TextInput::make('tech')->label('Tecnología')->required(),
                    ])
                    ->addActionLabel('Agregar tecnología')->reorderable()->collapsible()->grid(3),
            ]),

            Forms\Components\Section::make('Imágenes')->schema([
                Forms\Components\SpatieMediaLibraryFileUpload::make('cover')
                    ->label('Imagen de portada')->collection('cover')->image()
                    ->imageResizeMode('cover')->imageCropAspectRatio('16:9'),
                Forms\Components\SpatieMediaLibraryFileUpload::make('gallery')
                    ->label('Galería')->collection('gallery')->image()->multiple()->reorderable(),
            ]),

            Forms\Components\Section::make('Publicación')->columns(2)->schema([
                Forms\Components\Toggle::make('featured')->label('Proyecto destacado')->default(false),
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
                Tables\Columns\TextColumn::make('order')->label('#')->sortable()->width(50),
                Tables\Columns\IconColumn::make('featured')->label('Destacado')->boolean(),
                Tables\Columns\TextColumn::make('title')->label('Título')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('client')->label('Cliente')->searchable()->toggleable(),
                Tables\Columns\TextColumn::make('tech_stack')->label('Stack')
                    ->formatStateUsing(fn ($state) => is_array($state) ? implode(', ', array_column($state, 'tech')) : $state)
                    ->limit(40)->toggleable(),
                Tables\Columns\TextColumn::make('status')->label('Estado')->badge()->sortable(),
                Tables\Columns\TextColumn::make('published_at')->label('Publicado')->dateTime('d/m/Y')->sortable()->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')->label('Estado')->options(ContentStatus::class),
                Tables\Filters\TernaryFilter::make('featured')->label('Destacados'),
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
            ->visible(fn (Project $r) =>
                $r->status === ContentStatus::Draft &&
                auth()->user()?->hasAnyRole(['admin', 'editor'])
            )
            ->action(function (Project $record) {
                $record->update(['status' => ContentStatus::PendingReview]);
                Notification::make()->title('Enviado a revisión')->success()->send();
            });
    }

    private static function approveAction(): Tables\Actions\Action
    {
        return Tables\Actions\Action::make('approve')
            ->label('Aprobar')->icon('heroicon-o-check-circle')->color('success')
            ->visible(fn (Project $r) =>
                $r->status === ContentStatus::PendingReview &&
                auth()->user()?->hasAnyRole(['admin', 'approver'])
            )
            ->action(function (Project $record) {
                $record->update(['status' => ContentStatus::Approved, 'approved_by' => auth()->id()]);
                Notification::make()->title('Aprobado')->success()->send();
            });
    }

    private static function publishAction(): Tables\Actions\Action
    {
        return Tables\Actions\Action::make('publish')
            ->label('Publicar')->icon('heroicon-o-globe-alt')->color('info')
            ->visible(fn (Project $r) =>
                $r->status === ContentStatus::Approved &&
                auth()->user()?->hasAnyRole(['admin', 'approver'])
            )
            ->action(function (Project $record) {
                $record->update(['status' => ContentStatus::Published, 'published_at' => now()]);
                Notification::make()->title('Publicado')->success()->send();
            });
    }

    private static function rejectAction(): Tables\Actions\Action
    {
        return Tables\Actions\Action::make('reject')
            ->label('Rechazar')->icon('heroicon-o-x-circle')->color('danger')
            ->visible(fn (Project $r) =>
                $r->status === ContentStatus::PendingReview &&
                auth()->user()?->hasAnyRole(['admin', 'approver'])
            )
            ->action(function (Project $record) {
                $record->update(['status' => ContentStatus::Rejected]);
                Notification::make()->title('Rechazado')->warning()->send();
            });
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'edit'   => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
