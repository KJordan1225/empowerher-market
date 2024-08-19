<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Filament\Resources\ServiceResource\RelationManagers;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                ->helperText('Enter descriptive name of service provided.')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                ->helperText('Give optional description of service provided.[MAX:8000 char]')
                ->maxLength(8000),
                Forms\Components\TextInput::make('bid')
                ->helperText('Enter opening bid for service provided.')
                ->placeholder(0)
                ->maxLength(255)
                ->required(),
                Forms\Components\Select::make('service_experience')
                ->helperText('Select experience level of service provided.')
                    ->options([
                        'professional' => 'Professional',
                        'intermediate' => 'Intermediate',
                        'entry level' => 'Entry Level',
                    ])
                    ->required(),
                Forms\Components\Select::make('service_pay_type')
                ->helperText('Select whether bid is a fixed price or charged hourly.')
                    ->options([
                        'fixed' => 'Fixed',
                        'hourly' => 'Hourly',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('service_duration')
                ->placeholder('0 mon 0 day 0 hr')
                ->helperText('Estimate how long to complete the service [optional]')
                ->maxLength(255),
                Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->searchable()
                ->preload()
                ->createOptionForm([
                    Forms\Components\TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->label('Email address')
                        ->email()
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('password')
                        ->password()
                        ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                        ->dehydrated(fn (?string $state): bool => filled($state))
                        ->required(fn (string $operation): bool => $operation === 'create')
                ]) 
                ->default(function () {
                    $user = Auth::user(); // Get the authenticated user
                    $userId = Auth::id(); // Get the id of authenticated user
                    if(Auth::user()->id != 1) {
                        return Auth::user()->id;
                    }
                })
                ->visible(function () {
                    return (Auth::user()->id == 1);
                })
                ->required(),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
