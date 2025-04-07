<?php

namespace App\Filament\Admin\Resources;

use App\Models\Plan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Laravelcm\Subscriptions\Interval;
use TomatoPHP\FilamentTranslationComponent\Components\Translation;

class PlanResource extends Resource
{
    protected static ?string $model = Plan::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return 'Users';
    }

    public static function getNavigationLabel(): string
    {
        return 'Plans';
    }

    public static function getPluralLabel(): ?string
    {
        return 'Plans';
    }

    public static function getLabel(): ?string
    {
        return 'Plans';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Translation::make('name')
                            ->columnSpanFull()
                            ->label('Name')
                            ->required(),
                        Translation::make('description')
                            ->columnSpanFull()
                            ->label('Description'),
                        Forms\Components\Select::make('currency')
                            ->columnSpanFull()
                            ->default('USD')
                            ->searchable()
                            ->label('Currency')
                            ->options([
                                'EGP',
                                'USD',
                                'EUR',
                                'AED',
                                'SAR',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('price')
                            ->default(0)
                            ->label('Price')
                            ->required()
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\TextInput::make('signup_fee')
                            ->label('Signup Fee')
                            ->default(0)
                            ->numeric()
                            ->prefix('$'),
                        Forms\Components\Select::make('invoice_interval')
                            ->default(Interval::MONTH->value)
                            ->label('Invoice Interval')
                            ->options([
                                Interval::DAY->value => 'Day',
                                Interval::MONTH->value => 'Month',
                                Interval::YEAR->value => 'Year',
                            ])->required(),
                        Forms\Components\TextInput::make('invoice_period')
                            ->label('Invoice Period')
                            ->default(0)
                            ->numeric()
                            ->required(),
                        Forms\Components\Select::make('trial_interval')
                            ->default(Interval::MONTH->value)
                            ->label('Trial Interval')
                            ->default(0)
                            ->options([
                                Interval::DAY->value => 'Day',
                                Interval::MONTH->value => 'Month',
                                Interval::YEAR->value => 'Year',
                            ]),
                        Forms\Components\TextInput::make('trial_period')
                            ->label('Trial Period')
                            ->default(0)
                            ->numeric(),
                        Forms\Components\Toggle::make('is_active')
                            ->label('Is Active'),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('sort_order')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->sortable()
                    ->searchable()
                    ->money(locale: 'en', currency: function ($record){
                        return $record->currency;
                    })
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Is Active'),
            ])
            ->defaultSort('sort_order', 'aces')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
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

    public static function getRelations(): array
    {
        return [
            \App\Filament\Admin\Resources\PlanResource\RelationManagers\FeatureManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \App\Filament\Admin\Resources\PlanResource\Pages\ListPlans::route('/'),
            'create' => \App\Filament\Admin\Resources\PlanResource\Pages\CreatePlan::route('/create'),
            'edit' => \App\Filament\Admin\Resources\PlanResource\Pages\EditPlan::route('/{record}/edit'),
        ];
    }
}
