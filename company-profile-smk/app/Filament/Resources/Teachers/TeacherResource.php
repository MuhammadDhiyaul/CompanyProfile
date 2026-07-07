<?php

namespace App\Filament\Resources\Teachers;

use App\Filament\Resources\Teachers\Pages\CreateTeacher;
use App\Filament\Resources\Teachers\Pages\EditTeacher;
use App\Filament\Resources\Teachers\Pages\ListTeachers;
use App\Filament\Resources\Teachers\Schemas\TeacherForm;
use App\Filament\Resources\Teachers\Tables\TeachersTable;
use App\Models\Teacher;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

// Import komponen Form
use Filament\Schemas\Components\Section; 
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

// Import komponen Table
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;

use Filament\Actions\BulkAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    // Mengubah label menu di navigasi samping
    protected static ?string $navigationLabel = 'Guru';

    // Memasukkan menu ini ke dalam grup Master Data yang sudah kamu buat
    protected static string | \UnitEnum | null $navigationGroup = 'Master Data';

    // Mengubah judul halaman
    protected static ?string $pluralModelLabel = 'Guru';
    protected static ?string $modelLabel = 'Guru';

    public static function form(Schema $schema): Schema
    {
        return TeacherForm::configure($schema)
        ->schema([
                // Bagian Kiri: Informasi Utama (Lebar 2/3)
                Section::make('Informasi Utama')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(255),
                            
                        TextInput::make('nip')
                            ->label('NIP')
                            ->maxLength(50),
                            
                        TextInput::make('position')
                            ->label('Jabatan (Contoh: Guru Produktif, Wali Kelas)')
                            ->required()
                            ->maxLength(255),
                            
                        Select::make('jurusan_id')
                            ->label('Jurusan / Program Keahlian')
                            // Jika kamu sudah membuat relasi 'jurusan' di model Teacher, gunakan ini:
                            ->relationship('jurusan', 'name') 
                            ->searchable()
                            ->preload(),
                            
                        TextInput::make('education')
                            ->label('Pendidikan Terakhir')
                            ->maxLength(255),
                            
                        Textarea::make('bio')
                            ->label('Biografi Singkat')
                            ->columnSpanFull()
                            ->rows(4),
                    ])
                    ->columnSpan(['sm' => 2]), // Mengambil porsi 2 kolom di layar besar

                // Bagian Kanan: Kontak & Media (Lebar 1/3)
                Section::make('Kontak & Pengaturan')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Foto Profil')
                            ->disk('public')
                            ->directory('teachers')
                            ->image()
                            ->imageEditor(),
                            
                        TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                            
                        TextInput::make('phone')
                            ->label('No. Telepon / WhatsApp')
                            ->tel()
                            ->maxLength(20),
                            
                        TextInput::make('sort_order')
                            ->label('Urutan Tampil')
                            ->numeric()
                            ->default(0)
                            ->helperText('Angka lebih kecil akan tampil lebih dulu di website.'),
                            
                        Toggle::make('is_active')
                            ->label('Status Aktif')
                            ->default(true)
                            ->helperText('Matikan jika guru sudah tidak mengajar.'),
                    ])
                    ->columnSpan(['sm' => 1]), // Mengambil porsi 1 kolom di layar besar
            ])
            ->columns(3); // Membagi grid utama menjadi 3 kolom
    }

    public static function table(Table $table): Table
    {
        return TeachersTable::configure($table)
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
                    ->label('NIP')
                    ->searchable(),
                    
                TextColumn::make('position')
                    ->label('Jabatan')
                    ->searchable(),
                    
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->filters([
                // Filter bawaan kosong untuk sementara
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
            'index' => ListTeachers::route('/'),
            'create' => CreateTeacher::route('/create'),
            'edit' => EditTeacher::route('/{record}/edit'),
        ];
    }
}
