<?php

namespace App\Filament\Admin\Resources\PlanResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Laravelcm\Subscriptions\Interval;
use TomatoPHP\FilamentTranslationComponent\Components\Translation;

class FeatureManager extends RelationManager
{
    protected static string $relationship = 'features';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return 'Features';
    }

    /**
     * @return string|null
     */
    public static function getLabel(): ?string
    {
        return 'Features';
    }

    /**
     * @return string|null
     */
    public static function getModelLabel(): ?string
    {
        return 'Feature';
    }

    /**
     * @return string|null
     */
    public static function getPluralLabel(): ?string
    {
        return 'Features';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Translation::make('name')
                    ->label('Name')
                    ->columnSpanFull()
                    ->required(),
                Translation::make('description')
                    ->columnSpanFull()
                    ->label('Description'),
                Forms\Components\TextInput::make('value')
                    ->columnSpanFull()
                    ->default(0)
                    ->label('Value')
                    ->required(),
                Forms\Components\Select::make('resettable_interval')
                    ->default(Interval::DAY->value)
                    ->label('Reset Interval')
                    ->options([
                        Interval::DAY->value => 'Day',
                        Interval::MONTH->value => 'Month',
                        Interval::YEAR->value => 'Year',
                    ])->required(),
                Forms\Components\TextInput::make('resettable_period')
                    ->label('Reset Period')
                    ->required()
                    ->default(0)
                    ->numeric(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->recordTitleAttribute('feature')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('value')
                    ->label('Value')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('resettable_interval')
                    ->label('Reset Interval')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('resettable_period')
                    ->label('Reset Period')
                    ->sortable()
                    ->searchable(),
            ])
            ->defaultSort('sort_order', 'aces')
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
