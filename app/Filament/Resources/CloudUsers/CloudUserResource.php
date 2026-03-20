<?php

namespace App\Filament\Resources\CloudUsers;

use App\Filament\Resources\CloudUsers\RelationManagers\AlbumsRelationManager;
use App\Filament\Resources\CloudUsers\Schemas\CloudUserForm;
use App\Filament\Resources\CloudUsers\Schemas\CloudUserInfolist;
use App\Filament\Resources\CloudUsers\Tables\CloudUsersTable;
use App\Models\CloudUser;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CloudUserResource extends Resource
{
    protected static ?string $model = CloudUser::class;

    protected static ?string $slug = 'cloud-users';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CloudUserForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CloudUserInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CloudUsersTable::table($table);
    }

    public static function getRelations(): array
    {
        return [
            AlbumsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCloudUsers::route('/'),
            'create' => Pages\CreateCloudUser::route('/create'),
            'edit' => Pages\EditCloudUser::route('/{record}/edit'),
            'view' => Pages\ViewCloudUser::route('/{record}'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name'];
    }
}
