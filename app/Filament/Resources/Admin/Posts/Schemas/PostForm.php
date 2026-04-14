<?php

namespace App\Filament\Resources\Admin\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use App\Models\Category;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Bagian Kiri (2/3 Lebar)
                Group::make([
                    Section::make('Konten Utama')
                        ->description('Kelola isi dan informasi dasar postingan Anda.')
                        ->icon('heroicon-o-pencil-square') // Ikon berbeda
                        ->schema([
                            Group::make([
                                TextInput::make('title')
                                    ->rules('required | min:5 | max:10')
                                    ->validationMessages([
                                        'required' => 'Judul harus diisi.'
                                    ]),
                                TextInput::make('slug')
                                    ->required()
                                    ->minLength(3)
                                    ->unique(ignoreRecord: true)
                                    ->validationMessages([
                                        'unique' => 'Slug harus unik dan tidak boleh sama.',
                                    ])
                            ])->columns(2), // Membuat tampilan 2 kolom untuk field utama

                            Select::make('category_id')
                                ->relationship("category", "name")
                                ->label('Kategori')
                                ->options(Category::all()->pluck('name', 'id'))
                                ->required()
                                ->searchable(),
                            // ->preload(),

                            RichEditor::make('body') // Menggunakan 'body' agar sesuai dengan database
                                ->required()
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(2),

                // Bagian Kanan (1/3 Lebar)
                Group::make([
                    Section::make('Media')
                        ->description('Unggah gambar unggulan.')
                        ->icon('heroicon-o-photo') // Ikon berbeda
                        ->schema([
                            FileUpload::make('image')
                                ->required()
                                ->disk('public')
                                ->directory('posts')
                                ->image(), // Validasi hanya gambar
                        ]),

                    Section::make('Pengaturan & Meta')
                        ->description('Atur visibilitas dan label.')
                        ->icon('heroicon-o-cog-6-tooth') // Ikon berbeda
                        ->schema([

                            ColorPicker::make('color')
                                ->label('Warna Tema'),
                            Select::make('tags')
                                ->relationship('tags', 'name')
                                ->multiple()
                                ->preload(),
                            Checkbox::make('published')
                                ->label('Terbitkan Postingan'),
                            DateTimePicker::make('published_at')
                                ->label('Waktu Publikasi'),
                        ]),
                ])->columnSpan(1),
            ])
            ->columns(3); // Menetapkan total grid menjadi 3 kolom
    }
}
