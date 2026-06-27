<?php

namespace App\Filament\Pages;

use App\Models\SchoolProfile;
use Filament\Pages\Page;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;
use Filament\Schemas\Schema;

// 🚀 PERUBAHAN UTAMA: Section sekarang berada di namespace Schemas, bukan Forms!
use Filament\Schemas\Components\Section; 
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;

class ManageSchoolProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationLabel = 'Profil Sekolah';
    protected static ?string $title = 'Kelola Profil Sekolah';
    
    // Tanpa kata static untuk kompatibilitas PHP 8.4
    protected string $view = 'filament.pages.manage-school-profile'; 

    public ?array $data = [];

    public function mount(): void
    {
        $profile = SchoolProfile::firstOrNew(['id' => 1]);
        $this->form->fill($profile->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Utama')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Sekolah')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email Resmi')
                            ->email(),
                        TextInput::make('phone')
                            ->label('Nomor Telepon'),
                        Textarea::make('address')
                            ->label('Alamat Lengkap')
                            ->columnSpanFull(),
                    ])->columns(2),

                Section::make('Visi, Misi & Tentang')
                    ->schema([
                        RichEditor::make('about')
                            ->label('Tentang Sekolah')
                            ->columnSpanFull(),
                        RichEditor::make('vision')
                            ->label('Visi')
                            ->columnSpanFull(),
                        RichEditor::make('mission')
                            ->label('Misi')
                            ->columnSpanFull(),
                    ]),
                    
                Section::make('Media & Logo')
                    ->schema([
                        FileUpload::make('logo')
                            ->label('Logo Sekolah')
                            ->image()
                            ->directory('profiles'),
                        FileUpload::make('struktur_org_image')
                            ->label('Bagan Struktur Organisasi')
                            ->image()
                            ->directory('profiles'),
                    ])->columns(2),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $profile = SchoolProfile::firstOrNew(['id' => 1]);
        $profile->fill($this->form->getState());
        $profile->save();

        Notification::make()
            ->success()
            ->title('Berhasil disimpan')
            ->body('Data profil sekolah telah diperbarui.')
            ->send();
    }
}