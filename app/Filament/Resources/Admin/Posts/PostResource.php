<?php

// ✅ FIX: Namespace harus sesuai lokasi folder Admin/Posts
namespace App\Filament\Resources\Admin\Posts;

use App\Filament\Resources\Admin\Posts\Pages\CreatePost;
use App\Filament\Resources\Admin\Posts\Pages\EditPost;
use App\Filament\Resources\Admin\Posts\Pages\ListPosts;
use App\Filament\Resources\Admin\Posts\Schemas\PostForm;
use App\Filament\Resources\Admin\Posts\Tables\PostsTable;
use App\Filament\Resources\Admin\Posts\RelationManagers\TagsRelationManager;
use App\Models\Post;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $navigationLabel = 'Post';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return PostForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PostsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            TagsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListPosts::route('/'),
            'create' => CreatePost::route('/create'),
            'edit'   => EditPost::route('/{record}/edit'),
        ];
    }
}
