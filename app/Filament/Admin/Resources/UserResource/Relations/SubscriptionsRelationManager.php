<?php

namespace App\Filament\Admin\Resources\UserResource\Relations;

use App\Models\Subscription;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Builder;

class SubscriptionsRelationManager extends RelationManager
{
    protected static string $relationship = 'subscriptions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('plan_id')
                    ->relationship('plan', 'name')
                    ->searchable()
                    ->required(),
                Forms\Components\Toggle::make('active')
                    ->label('Active')
                    ->disabled(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('plan.name')
                    ->label('Plan')
                    ->sortable(),
                Tables\Columns\IconColumn::make('active')
                    ->boolean()
                    ->label('Active')
                    ->state(fn ($record) => $record->active()),
                Tables\Columns\TextColumn::make('starts_at')
                    ->dateTime()
                    ->label('Start Date'),
                Tables\Columns\TextColumn::make('ends_at')
                    ->dateTime()
                    ->label('End Date'),
                Tables\Columns\TextColumn::make('canceled_at')
                    ->dateTime()
                    ->label('Canceled At'),
            ])
            ->filters([
                Tables\Filters\Filter::make('active')
                    ->label('Active Subscriptions')
                    ->query(fn (Builder $query) => $query->where('ends_at', '>', now())),
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