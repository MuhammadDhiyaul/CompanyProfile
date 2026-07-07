<?php

namespace App\Filament\Resources\Fasilitas;

use App\Filament\Resources\Fasilitas\Pages\CreateFasilitas;
use App\Filament\Resources\Fasilitas\Pages\EditFasilitas;
use App\Filament\Resources\Fasilitas\Pages\ListFasilitas;
use App\Filament\Resources\Fasilitas\Schemas\FasilitasForm;
use App\Filament\Resources\Fasilitas\Tables\FasilitasTable;
use App\Models\Fasilitas;
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

class FasilitasResource extends Resource
{
    protected static ?string $model = Fasilitas::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?string $navigationLabel = 'Fasilitas';
    protected static string | \UnitEnum | null $navigationGroup = 'Master Data';
    protected static ?string $pluralModelLabel = 'Data Fasilitas';
    protected static ?string $modelLabel = 'Fasilitas';
    protected static ?int $navigationSort = 3; // Tampil di bawah Guru

    public static function form(Schema $schema): Schema
    {
        return FasilitasForm::configure($schema)
        ->schema([
                Section::make('Informasi Fasilitas')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Fasilitas / Ruangan')
                            ->required()
                            ->maxLength(255),
                        Select::make('condition')
                            ->label('Kondisi')
                            ->options([
                                'Baik' => 'Baik',
                                'Kurang Baik' => 'Kurang Baik',
                                'Sedang Direnovasi' => 'Sedang Direnovasi',
                            ])
                            ->default('Baik'),
                        Textarea::make('description')
                            ->label('Deskripsi Singkat')
                            ->columnSpanFull()
                            ->rows(3),
                        FileUpload::make('image')
                            ->label('Foto Fasilitas')
                            ->disk('public')
                            ->directory('fasilitas')
                            ->image()
                            ->imageEditor()
                            ->columnSpanFull(),
                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return FasilitasTable::configure($table)
        ->columns([
                ImageColumn::make('image')
                    ->label('Foto'),
                TextColumn::make('name')
                    ->label('Nama Fasilitas')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('condition')
                    ->label('Kondisi')
                    ->badge() // Membuat tampilan kondisi menjadi seperti label warna
                    ->color(fn (string $state): string => match ($state) {
                        'Baik' => 'success',
                        'Sedang Direnovasi' => 'warning',
                        'Kurang Baik' => 'danger',
                        default => 'gray',
                    }),
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
            'index' => ListFasilitas::route('/'),
            'create' => CreateFasilitas::route('/create'),
            'edit' => EditFasilitas::route('/{record}/edit'),
        ];
    }
}
