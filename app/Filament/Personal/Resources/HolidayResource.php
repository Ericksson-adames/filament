<?php

namespace App\Filament\Personal\Resources;

use App\Filament\Personal\Resources\HolidayResource\Pages;
use App\Filament\Personal\Resources\HolidayResource\RelationManagers;
use App\Models\Holiday;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HolidayResource extends Resource
{
    protected static ?string $model = Holiday::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Select::make('calendar_id')
                ->relationship('calendar', 'name' )
                ->required(),
                Forms\Components\Select::make('user_id')
                ->relationship('user','name')
                ->required(),
                Forms\Components\Select::make('type')
                ->options([
                    'decline' => 'Decline',
                    'approved'=> 'Approved',
                    'pending'=> 'Pending'
                ])
                ->required(),
                Forms\Components\DatePicker::make('day')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('calendar.name')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('type')
                ->sortable()
                ->color(fn (string $state): string => match ($state) {
                    'decline' => 'danger',
                    'approved'=> 'success',
                    'pending'=> 'warning'
                }),

                Tables\Columns\TextColumn::make('day')
                ->sortable()
                ->date(),
            ])
            ->filters([
                //
                SelectFilter::make('type')
                ->options([
                    'decline' => 'Decline',
                    'approved'=> 'Approved',
                    'pending'=> 'Pending'
                
                ])
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHolidays::route('/'),
            'create' => Pages\CreateHoliday::route('/create'),
            'edit' => Pages\EditHoliday::route('/{record}/edit'),
        ];
    }
}
