<?php

namespace App\Filament\Resources\Sliders;

use App\Filament\Resources\Sliders\Pages\CreateSlider;
use App\Filament\Resources\Sliders\Pages\EditSlider;
use App\Filament\Resources\Sliders\Pages\ListSliders;
use App\Filament\Resources\Sliders\Schemas\SliderForm;
use App\Filament\Resources\Sliders\Tables\SlidersTable;
use App\Models\Slider;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
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

class SliderResource extends Resource
{
    protected static ?string $model = Slider::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Website';
    protected static ?string $navigationLabel = 'Slider Banner';
    protected static ?string $pluralModelLabel = 'Data Slider';
    protected static ?string $modelLabel = 'Slider';
    protected static ?int $navigationSort = 5; // Tampil paling bawah di grup Website

    public static function form(Schema $schema): Schema
    {
        return SliderForm::configure($schema)
        ->schema([
                Section::make('Gambar Slider')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Unggah Gambar Banner')
                            ->disk('public')
                            ->directory('slider')
                            ->image()
                            ->imageEditor()
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Gunakan gambar dengan resolusi horizontal (landscape) agar tampil maksimal di website.'),
                    ]),

                Section::make('Teks & Tautan (Opsional)')
                    ->description('Isi bagian ini jika kamu ingin menampilkan teks di atas gambar.')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Utama')
                            ->maxLength(255),
                        TextInput::make('subtitle')
                            ->label('Subjudul / Deskripsi Singkat')
                            ->maxLength(255),
                        TextInput::make('button_text')
                            ->label('Teks Tombol (Contoh: Baca Selengkapnya)')
                            ->maxLength(255),
                        TextInput::make('button_link')
                            ->label('Link Tujuan (URL)')
                            ->url() // Memastikan input berupa format URL yang benar
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Pengaturan')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka lebih kecil akan tampil lebih dulu.'),
                        Toggle::make('is_active')
                            ->label('Tampilkan di Website')
                            ->default(true),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return SlidersTable::configure($table)
            ->columns([
                ImageColumn::make('image')
                    ->label('Gambar')
                    ->disk('public')
                    ->extraImgAttributes(['style' => 'width: 150px; height: auto; border-radius: 8px;']), // Sedikit CSS agar gambar tampil memanjang (landscape) di tabel
                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->placeholder('Tanpa Judul'), // Muncul jika teks judul dikosongkan
                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->sortable(),
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
            'index' => ListSliders::route('/'),
            'create' => CreateSlider::route('/create'),
            'edit' => EditSlider::route('/{record}/edit'),
        ];
    }
}
