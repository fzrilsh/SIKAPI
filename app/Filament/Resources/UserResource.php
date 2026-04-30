<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'User Management';

    public static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->is_super_admin;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Profile Information')
                    ->schema([
                        TextInput::make('name')->required(),
                        TextInput::make('email')->email()->required()->unique(User::class, 'email', ignoreRecord: true),
                        TextInput::make('password')
                            ->password()
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $operation): bool => $operation === 'create'),
                    ])->columns(2),
                Section::make('Permissions & Roles')
                    ->schema([
                        Toggle::make('is_super_admin')
                            ->label('Grant Super Admin Access')
                            ->helperText('Super Admins can manage all ministries and users.'),

                        Toggle::make('is_expert_verified')
                            ->label('Verified Legal Expert')
                            ->helperText('Users with this status can provide highlighted legal analysis.'),

                        Select::make('ministry_id')
                            ->relationship('ministry', 'name')
                            ->label('Assign to Ministry')
                            ->placeholder('Select a Ministry')
                            ->helperText('Assign this user as an admin for a specific government agency.')
                            ->searchable()
                            ->preload(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->searchable(),
                TextColumn::make('email')->searchable(),
                IconColumn::make('is_super_admin')
                    ->boolean()
                    ->label('Super Admin'),
                IconColumn::make('is_expert_verified')
                    ->boolean()
                    ->label('Expert'),
                TextColumn::make('ministry.name')
                    ->label('Ministry')
                    ->placeholder('None'),
            ])
            ->filters([
                TernaryFilter::make('is_super_admin'),
                TernaryFilter::make('is_expert_verified'),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
