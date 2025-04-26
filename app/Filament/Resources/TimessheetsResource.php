<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TimessheetsResource\Pages;
use App\Filament\Resources\TimessheetsResource\RelationManagers;
use App\Models\Timessheets;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TimessheetsResource extends Resource
{
    protected static ?string $model = Timessheets::class;
    protected static ?string $navigationGroup = 'Vacation Management';
    protected static ?int $navigationSort = 7;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            Forms\Components\Select::make('calendar_id')
            ->relationship(name: 'calendar', titleAttribute: 'name')
                ->required(),
                Forms\Components\Select::make('user_id')
            ->relationship(name: 'user', titleAttribute: 'name')
                ->required(),
                Forms\Components\Select::make('type')
                ->options([
                    'work'=> 'activo',
                    'pause'=> 'pausa',
                ])
                ->required(),
                Forms\Components\DateTimePicker::make('day_in')
                ->required(),
                Forms\Components\DateTimePicker::make('day_out')
                ->required(),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('calendar.name')
                ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                ->sortable(),
                Tables\Columns\TextColumn::make('type')
                ->sortable(),
                Tables\Columns\TextColumn::make('day_in')
                ->dateTime()
                ->sortable(),
                Tables\Columns\TextColumn::make('day_out')
                ->dateTime()
                ->sortable(),
            ])
            ->filters([
                //
                SelectFilter::make('type')
                ->options([
                    "work"=>'in working',
                    "pause"=> 'in pause'
                ])
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTimessheets::route('/'),
            'create' => Pages\CreateTimessheets::route('/create'),
            'edit' => Pages\EditTimessheets::route('/{record}/edit'),
        ];
    }
}
