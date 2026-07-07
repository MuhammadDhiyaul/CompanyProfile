<?php

namespace App\Filament\Resources\Pegawais;

use App\Filament\Resources\Pegawais\Pages\CreatePegawai;
use App\Filament\Resources\Pegawais\Pages\EditPegawai;
use App\Filament\Resources\Pegawais\Pages\ListPegawais;
use App\Filament\Resources\Pegawais\Schemas\PegawaiForm;
use App\Filament\Resources\Pegawais\Tables\PegawaisTable;
use App\Models\Pegawai;
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


class PegawaiResource extends Resource
{
    protected static ?string $model = Pegawai::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationLabel = 'Pegawai';
    protected static string | \UnitEnum | null $navigationGroup = 'Master Data';
    protected static ?string $pluralModelLabel = 'Data Pegawai';
    protected static ?string $modelLabel = 'Pegawai';
    protected static ?int $navigationSort = 3; // Tampil di bawah Guru

    public static function form(Schema $schema): Schema
    {
        return PegawaiForm::configure($schema)
        ->schema([
                Section::make('Informasi Pegawai')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('nip')
                            ->label('NIP / NIK')
                            ->maxLength(255),
                        TextInput::make('position')
                            ->label('Jabatan (Contoh: Tata Usaha, Keamanan)')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('No. Telepon / WhatsApp')
                            ->tel()
                            ->maxLength(255),
                        Textarea::make('bio')
                            ->label('Catatan / Bio Singkat')
                            ->columnSpanFull()
                            ->rows(3),
                    ])->columnSpan(['sm' => 2]),

                Section::make('Media & Status')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Foto Profil')
                            ->disk('public')
                            ->directory('pegawai')
                            ->image()
                            ->imageEditor(),
                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0),
                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true),
                    ])->columnSpan(['sm' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return PegawaisTable::configure($table)
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('nip')
                    ->label('NIP/NIK')
                    ->searchable(),
                TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Aktif')
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
            'index' => ListPegawais::route('/'),
            'create' => CreatePegawai::route('/create'),
            'edit' => EditPegawai::route('/{record}/edit'),
        ];
    }
}
