<?php

namespace App\Filament\Resources\Admin;

use App\Filament\Resources\Admin\BookingResource\Pages;
use App\Models\Booking;
use App\Models\Product;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;

// 1. PERBAIKAN: Menggunakan namespace Actions milik Filament v4!
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calendar-days';
    protected static ?string $navigationLabel = 'Booking Mobil';
    protected static ?string $pluralModelLabel = 'Booking Mobil';

    // ----------------------------------------------------
    // FUNGSI PERHITUNGAN TOTAL HARGA
    // ----------------------------------------------------
    protected static function updateTotalPrice(Get $get, Set $set): void
    {
        $productId = $get('product_id');
        $startDate = $get('start_date');
        $endDate = $get('end_date');

        if ($productId && $startDate && $endDate) {
            $product = Product::find($productId);
            
            if ($product) {
                $start = Carbon::parse($startDate);
                $end = Carbon::parse($endDate);

                if ($end->lessThan($start)) {
                    $set('total_price', 0);
                    return;
                }

                $duration = $start->diffInDays($end);
                if ($duration == 0) {
                    $duration = 1;
                }

                $totalPrice = $product->price * $duration;
                $set('total_price', $totalPrice);
            }
        }
    }

    // ----------------------------------------------------
    // FORM CONFIGURATION
    // ----------------------------------------------------
    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Pelanggan & Mobil')
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->label('Pilih Mobil')
                            ->relationship('product', 'name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set)),

                        Forms\Components\Select::make('user_id')
                            ->label('Akun User Terkait')
                            ->relationship('user', 'name')
                            ->searchable()
                            ->preload(),

                        Forms\Components\TextInput::make('customer_name')
                            ->label('Nama Pelanggan')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('customer_contact')
                            ->label('Kontak/No. HP')
                            ->required()
                            ->maxLength(255),
                    ])->columns(2),

                Section::make('Detail Sewa & Pembayaran')
                    ->schema([
                        Forms\Components\DatePicker::make('start_date')
                            ->label('Tanggal Mulai')
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set)),

                        Forms\Components\DatePicker::make('end_date')
                            ->label('Tanggal Selesai')
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn (Get $get, Set $set) => self::updateTotalPrice($get, $set)),

                        Forms\Components\TextInput::make('total_price')
                            ->label('Total Harga (Otomatis)')
                            ->numeric()
                            ->prefix('Rp')
                            ->readOnly()
                            ->required(),

                        Forms\Components\Select::make('payment_method')
                            ->label('Metode Pembayaran')
                            ->options([
                                'transfer' => 'Transfer Bank',
                                'e_wallet' => 'E-Wallet',
                                'cash' => 'Tunai / Cash',
                            ])->required(),

                        Forms\Components\Select::make('status')
                            ->label('Status Transaksi')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'cancelled' => 'Cancelled',
                            ])->default('pending')->required(),
                    ])->columns(2),

                Section::make('Informasi Tambahan Logistik')
                    ->schema([
                        Forms\Components\TextInput::make('pickup_location')
                            ->label('Lokasi Pengambilan'),

                        Forms\Components\TextInput::make('pickup_method')
                            ->label('Metode Pengambilan'),

                        Forms\Components\TextInput::make('return_method')
                            ->label('Metode Pengembalian'),

                        Forms\Components\TextInput::make('source_info')
                            ->label('Info Asal Orderan'),
                    ])->columns(2),
            ]);
    }

    // ----------------------------------------------------
    // TABLE CONFIGURATION
    // ----------------------------------------------------
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('product.name')
                    ->label('Mobil')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Mulai Sewa')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('Selesai Sewa')
                    ->date('d M Y'),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'confirmed' => 'success',
                        'pending' => 'warning',
                        'cancelled' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ]),
            ])
            // 2. PERBAIKAN: Menggunakan recordActions() untuk row tabel
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            // 3. PERBAIKAN: Menggunakan toolbarActions() untuk aksi massal
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    // ----------------------------------------------------
    // INFOLIST CONFIGURATION
    // ----------------------------------------------------
    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Rangkuman Booking')
                    ->schema([
                        Infolists\Components\TextEntry::make('product.name')->label('Mobil yang Disewa'),
                        Infolists\Components\TextEntry::make('customer_name')->label('Nama Pelanggan'),
                        Infolists\Components\TextEntry::make('customer_contact')->label('No. Telepon'),
                        Infolists\Components\TextEntry::make('total_price')->label('Total Harga')->money('IDR', locale: 'id'),
                        Infolists\Components\TextEntry::make('status')
                            ->label('Status')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'confirmed' => 'success',
                                'pending' => 'warning',
                                'cancelled' => 'danger',
                                default => 'gray',
                            }),
                    ])->columns(2),

                Section::make('Waktu & Logistik Pelaksanaan')
                    ->schema([
                        Infolists\Components\TextEntry::make('start_date')->label('Tanggal Mulai')->date('d F Y'),
                        Infolists\Components\TextEntry::make('end_date')->label('Tanggal Selesai')->date('d F Y'),
                        Infolists\Components\TextEntry::make('pickup_location')->label('Lokasi Jemput/Ambil'),
                        Infolists\Components\TextEntry::make('pickup_method')->label('Metode Pengambilan'),
                        Infolists\Components\TextEntry::make('return_method')->label('Metode Pengembalian'),
                        Infolists\Components\TextEntry::make('source_info')->label('Info Asal Orderan'),
                    ])->columns(2),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'view' => Pages\ViewBooking::route('/{record}'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}