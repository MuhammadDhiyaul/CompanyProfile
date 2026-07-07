<?php

namespace App\Filament\Resources\Galeris;

use App\Filament\Resources\Galeris\Pages\CreateGaleri;
use App\Filament\Resources\Galeris\Pages\EditGaleri;
use App\Filament\Resources\Galeris\Pages\ListGaleris;
use App\Filament\Resources\Galeris\Schemas\GaleriForm;
use App\Filament\Resources\Galeris\Tables\GalerisTable;
use App\Models\Galeri;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

use Filament\Actions\BulkAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;

class GaleriResource extends Resource
{
    protected static ?string $model = Galeri::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static string | \UnitEnum | null $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Galeri';
    protected static ?string $pluralModelLabel = 'Data Galeri';
    protected static ?string $modelLabel = 'Galeri';
    protected static ?int $navigationSort = 2; // Tampil di bawah Berita

    public static function form(Schema $schema): Schema
    {
        return GaleriForm::configure($schema)
        ->schema([
                Section::make('Informasi Album')
                    ->schema([
                        TextInput::make('title')
                            ->label('Nama Album (Contoh: Kegiatan Porseni 2026)')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('description')
                            ->label('Deskripsi Album')
                            ->columnSpanFull()
                            ->rows(3),
                        Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->default(true),
                    ])->columnSpanFull(),

                Section::make('Foto Album')
                    ->description('Kamu bisa mengunggah banyak foto sekaligus di sini.')
                    ->schema([
                        FileUpload::make('images')
                            ->label('Unggah Foto')
                            ->multiple() // MENGIZINKAN BANYAK FOTO
                            ->reorderable() // BISA MENGGESER URUTAN FOTO
                            ->disk('public')
                            ->directory('galeri')
                            ->image()
                            ->imageEditor()
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return GalerisTable::configure($table)
        ->columns([
                TextColumn::make('title')
                    ->label('Nama Album')
                    ->searchable()
                    ->sortable(),
                
                // Fitur keren Filament: Menampilkan banyak foto bertumpuk!
                ImageColumn::make('images')
                    ->label('Foto-foto')
                    ->stacked()
                    ->circular()
                    ->disk('public')
                    ->limit(3), // Menampilkan maksimal 3 tumpukan foto agar tabel tetap rapi
                    
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
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
            'index' => ListGaleris::route('/'),
            'create' => CreateGaleri::route('/create'),
            'edit' => EditGaleri::route('/{record}/edit'),
        ];
    }
}
