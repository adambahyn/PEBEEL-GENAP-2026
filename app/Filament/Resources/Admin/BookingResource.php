<?php

namespace App\Filament\Resources\Admin;

use App\Filament\Resources\Admin\BookingResource\Pages;
use App\Models\Booking;
use Filament\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationLabel = 'Booking Mobil';

    protected static ?string $modelLabel = 'Booking';

    protected static ?string $pluralModelLabel = 'Bookings';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informasi Pesanan')
                ->schema([
                    Select::make('car_id')
                        ->label('🚗 Pilih Mobil')
                        ->relationship('car', 'model')
                        ->getOptionLabelFromRecordUsing(fn ($record) => "{$record->brand} {$record->model}")
                        ->required()
                        ->live()
                        ->afterStateUpdated(fn (Set $set) => $set('total_price', 0)),

                    TextInput::make('customer_name')
                        ->label('👤 Nama Lengkap')
                        ->required(),

                    TextInput::make('customer_contact')
                        ->label('📞 Nomor WA')
                        ->required(),

                    DatePicker::make('start_date')
                        ->label('📅 Tanggal Mulai')
                        ->required()
                        ->minDate(now()),

                    TextInput::make('duration')
                        ->label('⏱️ Durasi (Hari)')
                        ->numeric()
                        ->required()
                        ->minValue(1)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Get $get, Set $set) {
                            $carId = $get('car_id');
                            $duration = intval($get('duration'));
                            
                            if ($carId && $duration) {
                                $car = \App\Models\Car::find($carId);
                                $price = $car ? $car->price : 0;
                                $set('total_price', $price * $duration);
                            }
                        }),

                    TextInput::make('total_price')
                        ->label('💰 Total Harga')
                        ->numeric()
                        ->prefix('IDR')
                        ->readOnly(),

                    Select::make('payment_method')
                        ->label('💳 Metode Pembayaran')
                        ->options([
                            'transfer' => 'Transfer Bank',
                            'e_wallet' => 'E-Wallet (GoPay, OVO, Dana)',
                            'cash' => 'Tunai',
                        ])
                        ->required(),

                    Select::make('status')
                        ->label('📋 Status')
                        ->options([
                            'pending' => 'Menunggu Konfirmasi',
                            'confirmed' => 'Dikonfirmasi',
                            'completed' => 'Selesai',
                            'cancelled' => 'Dibatalkan',
                        ])
                        ->default('pending')
                        ->required(),
                ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('car.brand')
                    ->label('Mobil')
                    ->formatStateUsing(fn ($record) => "{$record->car->brand} {$record->car->model}")
                    ->sortable(),

                Tables\Columns\TextColumn::make('customer_name')
                    ->label('Nama Pelanggan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('customer_contact')
                    ->label('Kontak')
                    ->searchable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Tanggal Mulai')
                    ->date('d/m/Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('duration')
                    ->label('Durasi (Hari)')
                    ->suffix(' hari'),

                Tables\Columns\TextColumn::make('total_price')
                    ->label('Total Harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_method')
                    ->label('Pembayaran')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'transfer' => 'Transfer Bank',
                        'e_wallet' => 'E-Wallet',
                        'cash' => 'Tunai',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                    })
                    ->formatStateUsing(fn ($state) => match($state) {
                        'pending' => 'Menunggu Konfirmasi',
                        'confirmed' => 'Dikonfirmasi',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                        default => $state,
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'pending' => 'Menunggu Konfirmasi',
                        'confirmed' => 'Dikonfirmasi',
                        'completed' => 'Selesai',
                        'cancelled' => 'Dibatalkan',
                    ]),

                Tables\Filters\SelectFilter::make('payment_method')
                    ->options([
                        'transfer' => 'Transfer Bank',
                        'e_wallet' => 'E-Wallet',
                        'cash' => 'Tunai',
                    ]),
            ])
            ->actions([
                Actions\ViewAction::make(),
                Actions\EditAction::make(),
            ])
            ->bulkActions([
                Actions\BulkActionGroup::make([
                    Actions\DeleteBulkAction::make(),
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
            'index' => \App\Filament\Resources\Admin\BookingResource\Pages\ListBookings::route('/'),
            'create' => \App\Filament\Resources\Admin\BookingResource\Pages\CreateBooking::route('/create'),
            'view' => \App\Filament\Resources\Admin\BookingResource\Pages\ViewBooking::route('/{record}'),
            'edit' => \App\Filament\Resources\Admin\BookingResource\Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}