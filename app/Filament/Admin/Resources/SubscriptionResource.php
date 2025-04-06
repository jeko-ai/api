<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\FilamentSubscriptions;
use App\Filament\Resources\SubscriptionResource\Pages;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): ?string
    {
        return trans('messages.group');
    }

    public static function getNavigationLabel(): string
    {
        return trans('messages.subscriptions.title');
    }

    public static function getPluralLabel(): ?string
    {
        return trans('messages.subscriptions.title');
    }

    public static function getLabel(): ?string
    {
        return trans('messages.subscriptions.title');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema( [
                Forms\Components\Hidden::make('name'),
                Forms\Components\Select::make('subscriber_type')
                    ->label(trans('messages.subscriptions.sections.subscriber.columns.subscriber_type'))
                    ->options(count(FilamentSubscriptions::getOptions()) ? FilamentSubscriptions::getOptions()->pluck('name', 'model')->toArray() : [User::class => 'Users'])
                    ->afterStateUpdated(fn(Forms\Get $get, Forms\Set $set) => $set('subscriber_id', null))
                    ->preload()
                    ->live()
                    ->searchable(),
                Forms\Components\Select::make('subscriber_id')
                    ->label(trans('messages.subscriptions.sections.subscriber.columns.subscriber'))
                    ->options(fn(Forms\Get $get) => $get('subscriber_type') ? $get('subscriber_type')::pluck('name', 'id')->toArray() : [])
                    ->searchable(),
                Forms\Components\Select::make('plan_id')
                    ->columnSpanFull()
                    ->searchable()
                    ->label(trans('messages.subscriptions.sections.plan.columns.plan'))
                    ->options(Plan::query()->where('is_active', 1)->pluck('name', 'id')->toArray())
                    ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set){
                        $set('name', $get('plan_id') ? Plan::find($get('plan_id'))->name : null);
                    })
                    ->required(),
                Forms\Components\Toggle::make('use_custom_dates')
                    ->columnSpanFull()
                    ->label(trans('messages.subscriptions.sections.plan.columns.use_custom_dates'))
                    ->live()
                    ->required(),
                    Forms\Components\DatePicker::make('trial_ends_at')
                        ->visible(fn(Forms\Get $get) => $get('use_custom_dates'))
                        ->label(trans('messages.subscriptions.sections.custom_dates.columns.trial_ends_at'))
                        ->required(fn(Forms\Get $get) => $get('use_custom_dates')),
                    Forms\Components\DatePicker::make('starts_at')
                        ->visible(fn(Forms\Get $get) => $get('use_custom_dates'))
                        ->label(trans('messages.subscriptions.sections.custom_dates.columns.starts_at'))
                        ->required(fn(Forms\Get $get) => $get('use_custom_dates')),
                    Forms\Components\DatePicker::make('ends_at')
                        ->visible(fn(Forms\Get $get) => $get('use_custom_dates'))
                        ->label(trans('messages.subscriptions.sections.custom_dates.columns.ends_at'))
                        ->required(fn(Forms\Get $get) => $get('use_custom_dates')),
                    Forms\Components\DatePicker::make('canceled_at')
                        ->visible(fn(Forms\Get $get) => $get('use_custom_dates'))
                        ->label(trans('messages.subscriptions.sections.custom_dates.columns.canceled_at'))
                        ->required(fn(Forms\Get $get) => $get('use_custom_dates')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('subscriber.name')
                    ->label(trans('messages.subscriptions.columns.subscriber'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('plan.name')
                    ->label(trans('messages.subscriptions.columns.plan'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('active')
                    ->state(function ($record){
                        return $record->active();
                    })
                    ->boolean()
                    ->label(trans('messages.subscriptions.columns.active'))
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('trial_ends_at')->dateTime()
                    ->label(trans('messages.subscriptions.columns.trial_ends_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('starts_at')->dateTime()
                    ->label(trans('messages.subscriptions.columns.starts_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('ends_at')->dateTime()
                    ->label(trans('messages.subscriptions.columns.ends_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('canceled_at')->dateTime()
                    ->label(trans('messages.subscriptions.columns.canceled_at'))
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\Filter::make(trans('messages.subscriptions.filters.date_range'))
                    ->form([
                        Forms\Components\DatePicker::make('start_date')
                            ->label(trans('messages.subscriptions.filters.start_date'))
                            ->required(),
                        Forms\Components\DatePicker::make('end_date')
                            ->label(trans('messages.subscriptions.filters.end_date'))
                            ->required(),
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (!isset($data['start_date']) || !isset($data['end_date'])) {
                            return $query;
                        }
                        return $query->whereBetween('starts_at', [$data['start_date'], $data['end_date']]);
                    }),
                Tables\Filters\Filter::make(trans('messages.subscriptions.filters.canceled'))
                    ->form([
                        Forms\Components\Select::make('canceled')
                            ->options([
                                '' => trans('messages.subscriptions.filters.all'),
                                '1' => trans('messages.subscriptions.filters.yes'),
                                '0' => trans('messages.subscriptions.filters.no'),
                            ])
                            ->label(trans('messages.subscriptions.filters.canceled'))
                            ->required(),
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (!isset($data['canceled'])) {
                            return $query;
                        }
                        if ($data['canceled'] === '1') {
                            return $query->whereNotNull('canceled_at');
                        }
                        if ($data['canceled'] === '0') {
                            return $query->whereNull('canceled_at');
                        }
                        return $query;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->tooltip(__('filament-actions::edit.single.label'))
                    ->iconButton(),
                Tables\Actions\Action::make('cancel')
                    ->visible(fn($record) => $record->active())
                    ->iconButton()
                    ->label(trans('messages.subscriptions.actions.cancel'))
                    ->tooltip(trans('messages.subscriptions.actions.cancel'))
                    ->icon('heroicon-o-x-circle')
                    ->color('warning')
                    ->action(function(Subscription $record){
                        $record->cancel(true);

                        Notification::make()
                            ->title(trans('messages.notifications.cancel.title'))
                            ->body(trans('messages.notifications.cancel.message'))
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation(),
                Tables\Actions\Action::make('renew')
                    ->visible(fn($record) => $record->ended())
                    ->iconButton()
                    ->label(trans('messages.subscriptions.actions.renew'))
                    ->tooltip(trans('messages.subscriptions.actions.renew'))
                    ->icon('heroicon-o-arrow-path-rounded-square')
                    ->color('info')
                    ->action(function(Subscription $record){
                        $record->canceled_at =  Carbon::parse($record->cancels_at)->addDays(1);
                        $record->cancels_at = Carbon::parse($record->cancels_at)->addDays(1);
                        $record->ends_at =  Carbon::parse($record->cancels_at)->addDays(1);
                        $record->save();
                        $record->renew();

                        Notification::make()
                            ->title(trans('messages.notifications.renew.title'))
                            ->body(trans('messages.notifications.renew.message'))
                            ->success()
                            ->send();

                    })
                    ->requiresConfirmation(),
                Tables\Actions\DeleteAction::make()
                    ->tooltip(__('filament-actions::delete.single.label'))
                    ->iconButton(),
                Tables\Actions\ForceDeleteAction::make()
                    ->tooltip(__('filament-actions::force-delete.single.label'))
                    ->iconButton(),
                Tables\Actions\RestoreAction::make()
                    ->tooltip(__('filament-actions::restore.single.label'))
                    ->iconButton(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make()
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
            'index' => \App\Filament\Admin\Resources\SubscriptionResource\Pages\ListSubscriptions::route('/')
        ];
    }
}
