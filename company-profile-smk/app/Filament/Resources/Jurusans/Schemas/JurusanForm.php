<?php

namespace App\Filament\Resources\Jurusans\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class JurusanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Informasi Jurusan')
                    ->schema([

                        TextInput::make('name')
                            ->label('Nama Jurusan')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),

                        TextInput::make('code')
                            ->label('Kode Jurusan')
                            ->required(),

                        TextInput::make('slug')
                            ->required(),

                        TextInput::make('head_of_department')
                            ->label('Kepala Program Keahlian'),

                        Select::make('accreditation')
                            ->options([
                                'A' => 'A',
                                'B' => 'B',
                                'C' => 'C',
                                'Unggul' => 'Unggul',
                            ]),

                        Toggle::make('is_active')
                            ->default(true),

                        TextInput::make('sort_order')
                            ->numeric()
                            ->default(0),

                    ])
                    ->columns(2),

                Section::make('Deskripsi')
                    ->schema([

                        RichEditor::make('description')
                            ->columnSpanFull(),

                    ]),

                Section::make('Media')
                    ->schema([

                        FileUpload::make('image')
                            ->directory('jurusans')
                            ->image()
                            ->imageEditor()
                            ->disk('public'),
                    ]),
            ]);
    }
}