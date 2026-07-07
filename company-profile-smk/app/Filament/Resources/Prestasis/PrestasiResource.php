<?php

namespace App\Filament\Resources\Prestasis;

use App\Filament\Resources\Prestasis\Pages\CreatePrestasi;
use App\Filament\Resources\Prestasis\Pages\EditPrestasi;
use App\Filament\Resources\Prestasis\Pages\ListPrestasis;
use App\Filament\Resources\Prestasis\Schemas\PrestasiForm;
use App\Filament\Resources\Prestasis\Tables\PrestasisTable;
use App\Models\Prestasi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

use Filament\Actions\BulkAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;

class PrestasiResource extends Resource
{
    protected static ?string $model = Prestasi::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-star';

    protected static string | \UnitEnum | null $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Prestasi';
    protected static ?string $pluralModelLabel = 'Data Prestasi';
    protected static ?string $modelLabel = 'Prestasi';
    protected static ?int $navigationSort = 3; // Tampil di bawah Galeri

    public static function form(Schema $schema): Schema
    {
        return PrestasiForm::configure($schema)
        ->schema([
                Section::make('Informasi Pencapaian')
                    ->schema([
                        TextInput::make('title')
                            ->label('Nama Prestasi (Contoh: Juara 1 Web Design)')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('student_name')
                            ->label('Nama Siswa / Tim')
                            ->required()
                            ->maxLength(255),
                        Select::make('level')
                            ->label('Tingkat Perlombaan')
                            ->options([
                                'Sekolah' => 'Sekolah',
                                'Kabupaten/Kota' => 'Kabupaten/Kota',
                                'Provinsi' => 'Provinsi',
                                'Nasional' => 'Nasional',
                                'Internasional' => 'Internasional',
                            ])
                            ->required(),
                        DatePicker::make('date')
                            ->label('Tanggal Diraih')
                            ->required(),
                        Textarea::make('description')
                            ->label('Deskripsi Singkat')
                            ->columnSpanFull()
                            ->rows(3),
                    ])->columns(2)->columnSpan(['sm' => 2]),

                Section::make('Media')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Foto Bukti / Piala / Siswa')
                            ->disk('public')
                            ->directory('prestasi')
                            ->image()
                            ->imageEditor()
                            ->columnSpanFull(),
                    ])->columnSpan(['sm' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return PrestasisTable::configure($table)
        ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public'),
                TextColumn::make('title')
                    ->label('Nama Prestasi')
                    ->searchable()
                    ->sortable()
                    ->wrap(), // Membungkus teks jika terlalu panjang
                TextColumn::make('student_name')
                    ->label('Peraih')
                    ->searchable(),
                TextColumn::make('level')
                    ->label('Tingkat')
                    ->badge()
                    ->color('info'), // Memberikan warna label yang cantik
                TextColumn::make('date')
                    ->label('Tanggal')
                    ->date('d M Y')
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
            'index' => ListPrestasis::route('/'),
            'create' => CreatePrestasi::route('/create'),
            'edit' => EditPrestasi::route('/{record}/edit'),
        ];
    }
}
