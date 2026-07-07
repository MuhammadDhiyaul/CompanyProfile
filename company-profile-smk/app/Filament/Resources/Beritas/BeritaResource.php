<?php

namespace App\Filament\Resources\Beritas;

use App\Filament\Resources\Beritas\Pages\CreateBerita;
use App\Filament\Resources\Beritas\Pages\EditBerita;
use App\Filament\Resources\Beritas\Pages\ListBeritas;
use App\Filament\Resources\Beritas\Schemas\BeritaForm;
use App\Filament\Resources\Beritas\Tables\BeritasTable;
use App\Models\Berita;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

// Import tambahan untuk fitur Auto-Slug
use Illuminate\Support\Str;
// use Filament\Forms\Set;
use Filament\Schemas\Components\Utilities\Set;


use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
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


class BeritaResource extends Resource
{
    protected static ?string $model = Berita::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-newspaper';

    protected static ?string $navigationLabel = 'Berita';
    
    // PERHATIKAN: Kita buat grup baru bernama 'Website' sesuai arsitekturmu
    protected static string | \UnitEnum | null $navigationGroup = 'Website'; 
    
    protected static ?string $pluralModelLabel = 'Data Berita';
    protected static ?string $modelLabel = 'Berita';
    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return BeritaForm::configure($schema)
        ->schema([
                Section::make('Konten Berita')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Berita')
                            ->required()
                            ->maxLength(255)
                            ->live(debounce: 500) // <-- Ubah bagian ini (memberi jeda 0.5 detik saat mengetik)
                            ->afterStateUpdated(function (Set $set, ?string $state, string $operation) {
                            // Hanya mengubah slug otomatis saat membuat berita baru (agar URL berita lama tidak rusak)
                                if ($operation === 'create') {
                                    $set('slug', Str::slug($state));
                                }
                            }),
                        TextInput::make('slug')
                            ->label('URL Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true), // Harus unik agar URL tidak bentrok
                            
                        RichEditor::make('content')
                            ->label('Isi Berita')
                            ->required()
                            ->columnSpanFull(),
                    ])->columnSpan(['sm' => 2]),

                Section::make('Pengaturan & Media')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Gambar Utama (Thumbnail)')
                            ->disk('public')
                            ->directory('berita')
                            ->image()
                            ->imageEditor(),
                            
                        Toggle::make('is_published')
                            ->label('Publikasikan')
                            ->default(true)
                            ->helperText('Matikan jika berita masih berupa draft.'),
                    ])->columnSpan(['sm' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return BeritasTable::configure($table)
        ->columns([
                ImageColumn::make('image')
                    ->label('Gambar'),
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->limit(50), // Membatasi panjang teks di tabel agar rapi
                IconColumn::make('is_published')
                    ->label('Status Publikasi')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Tanggal Dibuat')
                    ->dateTime('d M Y')
                    ->sortable(),
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
            'index' => ListBeritas::route('/'),
            'create' => CreateBerita::route('/create'),
            'edit' => EditBerita::route('/{record}/edit'),
        ];
    }
}
