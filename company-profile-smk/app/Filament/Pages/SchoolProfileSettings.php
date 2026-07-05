<?php

namespace App\Filament\Pages;

use App\Models\SchoolProfile;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

use Filament\Schemas\Components\Section; 
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;



class SchoolProfileSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationLabel = 'Profil Sekolah';

    protected static string | \UnitEnum | null $navigationGroup = 'Master Data';

    protected static ?string $title = 'Profil Sekolah';

    protected static ?string $slug = 'profil-sekolah';

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-building-library';

    protected string $view = 'filament.pages.school-profile-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $profile = SchoolProfile::firstOrCreate(
            ['id' => 1],
            ['name' => 'SMK Al Fithrah Malang']
        );

        $this->form->fill($profile->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([

                Tabs::make('Tabs')

                    ->tabs([

                        /*
                        |--------------------------------------------------------------------------
                        | IDENTITAS
                        |--------------------------------------------------------------------------
                        */

                        Tab::make('Identitas')

                            ->schema([

                                Section::make('Informasi Sekolah')

                                    ->schema([

                                        TextInput::make('name')
                                            ->required(),

                                        TextInput::make('short_name'),

                                        TextInput::make('npsn'),

                                        TextInput::make('nss'),

                                        Toggle::make('is_active')
                                            ->default(true),

                                        Select::make('accreditation')
                                            ->options([
                                                'A' => 'A',
                                                'B' => 'B',
                                                'C' => 'C',
                                                'Unggul' => 'Unggul',
                                            ]),

                                        TextInput::make('principal')
                                            ->label('Kepala Sekolah'),

                                    ])

                                    ->columns(2),

                            ]),

                        /*
                        |--------------------------------------------------------------------------
                        | KONTAK
                        |--------------------------------------------------------------------------
                        */

                        Tab::make('Kontak')

                            ->schema([

                                Section::make()

                                    ->schema([

                                        TextInput::make('email')
                                            ->email(),

                                        TextInput::make('phone'),

                                        TextInput::make('whatsapp'),

                                        TextInput::make('website'),

                                        Textarea::make('address')
                                            ->columnSpanFull(),

                                        TextInput::make('postal_code'),

                                        Textarea::make('google_maps')
                                            ->columnSpanFull(),

                                    ])

                                    ->columns(2),

                            ]),

                        /*
                        |--------------------------------------------------------------------------
                        | PROFIL
                        |--------------------------------------------------------------------------
                        */

                        Tab::make('Profil')

                            ->schema([

                                RichEditor::make('history')
                                    ->label('Sejarah'),

                                RichEditor::make('vision')
                                    ->label('Visi'),

                                RichEditor::make('mission')
                                    ->label('Misi'),

                            ]),

                        /*
                        |--------------------------------------------------------------------------
                        | MEDIA
                        |--------------------------------------------------------------------------
                        */

                        Tab::make('Media')

                            ->schema([

                                FileUpload::make('logo')
                                    ->disk('public')
                                    ->directory('school')
                                    ->image()
                                    ->imageEditor()
                                    ->imagePreviewHeight('200'),

                                FileUpload::make('favicon')
                                    ->disk('public')
                                    ->directory('school')
                                    ->image()
                                    ->imageEditor()
                                    ->imagePreviewHeight('120'),

                                FileUpload::make('hero_image')
                                    ->disk('public')
                                    ->directory('school')
                                    ->image()
                                    ->imageEditor()
                                    ->imagePreviewHeight('250'),

                            ]),

                        /*
                        |--------------------------------------------------------------------------
                        | SOSIAL MEDIA
                        |--------------------------------------------------------------------------
                        */

                        Tab::make('Sosial Media')

                            ->schema([

                                TextInput::make('facebook'),

                                TextInput::make('instagram'),

                                TextInput::make('youtube'),

                                TextInput::make('tiktok'),

                            ]),

                    ])

                    ->columnSpanFull(),

            ])

            ->statePath('data');
    }

    public function save(): void
    {
        $profile = SchoolProfile::findOrFail(1);

        $profile->update(
            $this->form->getState()
        );

        Notification::make()

            ->title('Berhasil')

            ->body('Profil sekolah berhasil diperbarui.')

            ->success()

            ->send();
    }
}