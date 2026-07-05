<?php

namespace App\Filament\Resources\Jurusans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class JurusansTable
{
    public static function configure(Table $table): Table
    {
        return $table

            ->columns([

                ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public')
                    ->visibility('public')
                    ->square(),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('code')
                    ->searchable(),

                TextColumn::make('head_of_department')
                    ->label('Kaprodi'),

                TextColumn::make('accreditation')
                    ->badge(),

                IconColumn::make('is_active')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->date('d M Y'),

            ])

            ->filters([
                SelectFilter::make('is_active')
                ->label('Status')
                ->options([
                    true => 'Aktif',
                    false => 'Nonaktif',
                ]),
])

            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])

            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}