<?php

namespace App\Filament\Personal\Resources;

use App\Filament\Personal\Resources\TimessheetsResource\Pages;
use App\Filament\Personal\Resources\TimessheetsResource\RelationManagers;
use App\Models\timessheets;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class TimessheetsResource extends Resource
{
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::user()->id);
    }    
    protected static ?string $model = timessheets::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Select::make('calendar_id')
                ->relationship(name: 'calendar', titleAttribute: 'name')
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
                ->label('calendario')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('type')
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('day_in')
                ->dateTime()
                ->sortable()
                ->searchable(),
                Tables\Columns\TextColumn::make('day_out')
                ->dateTime()
                ->sortable()
                ->searchable(),
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
