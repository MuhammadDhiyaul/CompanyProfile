<?php

namespace App\Filament\Resources\Pengumumen;

use App\Filament\Resources\Pengumumen\Pages\CreatePengumuman;
use App\Filament\Resources\Pengumumen\Pages\EditPengumuman;
use App\Filament\Resources\Pengumumen\Pages\ListPengumumen;
use App\Filament\Resources\Pengumumen\Schemas\PengumumanForm;
use App\Filament\Resources\Pengumumen\Tables\PengumumenTable;
use App\Models\Pengumuman;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

use Filament\Actions\BulkAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;

class PengumumanResource extends Resource
{
    protected static ?string $model = Pengumuman::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-megaphone';

    protected static string | \UnitEnum | null $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Pengumuman';
    protected static ?string $pluralModelLabel = 'Data Pengumuman';
    protected static ?string $modelLabel = 'Pengumuman';
    protected static ?int $navigationSort = 4; // Tampil di bawah Prestasi

    public static function form(Schema $schema): Schema
    {
        return PengumumanForm::configure($schema)
            ->schema([
                Section::make('Isi Pengumuman')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Pengumuman (Contoh: Libur Hari Raya)')
                            ->required()
                            ->maxLength(255),
                        RichEditor::make('content')
                            ->label('Detail Pengumuman')
                            ->required()
                            ->columnSpanFull(),
                    ])->columnSpan(['sm' => 2]),

                Section::make('Lampiran & Status')
                    ->schema([
                        FileUpload::make('attachment')
                            ->label('File Lampiran (Opsional)')
                            ->disk('public')
                            ->directory('pengumuman')
                            ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                            ->helperText('Unggah file PDF atau Word jika ada surat edaran.')
                            ->downloadable(), // Membuat file bisa didownload
                        Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->default(true),
                    ])->columnSpan(['sm' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return PengumumenTable::configure($table)
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Pengumuman')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                IconColumn::make('attachment')
                    ->label('Ada Lampiran?')
                    ->boolean()
                    ->default(false)
                    ->getStateUsing(fn ($record): bool => (bool) $record->attachment), // Ngecek apakah file lampiran kosong atau tidak
                IconColumn::make('is_active')
                    ->label('Status')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Tanggal')
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
            'index' => ListPengumumen::route('/'),
            'create' => CreatePengumuman::route('/create'),
            'edit' => EditPengumuman::route('/{record}/edit'),
        ];
    }
}
