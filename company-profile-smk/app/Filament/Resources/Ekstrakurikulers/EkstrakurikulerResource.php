<?php

namespace App\Filament\Resources\Ekstrakurikulers;

use App\Filament\Resources\Ekstrakurikulers\Pages\CreateEkstrakurikuler;
use App\Filament\Resources\Ekstrakurikulers\Pages\EditEkstrakurikuler;
use App\Filament\Resources\Ekstrakurikulers\Pages\ListEkstrakurikulers;
use App\Filament\Resources\Ekstrakurikulers\Schemas\EkstrakurikulerForm;
use App\Filament\Resources\Ekstrakurikulers\Tables\EkstrakurikulersTable;
use App\Models\Ekstrakurikuler;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

use Filament\Actions\BulkAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;

class EkstrakurikulerResource extends Resource
{
    protected static ?string $model = Ekstrakurikuler::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-c-puzzle-piece';

    protected static ?string $navigationLabel = 'Ekstrakurikuler';
    protected static string | \UnitEnum | null $navigationGroup = 'Master Data';
    protected static ?string $pluralModelLabel = 'Data Ekstrakurikuler';
    protected static ?string $modelLabel = 'Ekstrakurikuler';
    protected static ?int $navigationSort = 5; // Tampil paling bawah di grup Master Data

    public static function form(Schema $schema): Schema
    {
        return EkstrakurikulerForm::configure($schema)
        ->schema([
                Section::make('Informasi Ekstrakurikuler')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Ekstrakurikuler')
                            ->required()
                            ->maxLength(255),
                        Select::make('teacher_id')
                            ->label('Guru Pembina')
                            ->relationship('teacher', 'name') // Mengambil nama guru dari relasi
                            ->searchable()
                            ->preload(),
                        Textarea::make('description')
                            ->label('Deskripsi Kegiatan')
                            ->columnSpanFull()
                            ->rows(3),
                        FileUpload::make('image')
                            ->label('Logo / Foto Kegiatan')
                            ->disk('public')
                            ->directory('ekstrakurikuler')
                            ->image()
                            ->imageEditor()
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return EkstrakurikulersTable::configure($table)
        ->columns([
                ImageColumn::make('image')
                    ->label('Logo/Foto'),
                TextColumn::make('name')
                    ->label('Nama Ekskul')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('teacher.name')
                    ->label('Pembina')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEkstrakurikulers::route('/'),
            'create' => CreateEkstrakurikuler::route('/create'),
            'edit' => EditEkstrakurikuler::route('/{record}/edit'),
        ];
    }
}
