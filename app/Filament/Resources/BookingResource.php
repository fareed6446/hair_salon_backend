<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Bookings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'full_name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('service_id')
                    ->relationship('service', 'title')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('package_id')
                    ->relationship('package', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\Select::make('stylist_id')
                    ->relationship('stylist', 'name')
                    ->searchable()
                    ->preload(),
                Forms\Components\DateTimePicker::make('date_time')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'booked' => 'Booked',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                        'no_show' => 'No Show',
                    ])
                    ->required(),
                Forms\Components\TextInput::make('loyalty_points_awarded')
                    ->numeric()
                    ->default(0),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.full_name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('service.title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('stylist.name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'booked',
                        'danger' => 'cancelled',
                        'warning' => 'completed',
                        'secondary' => 'no_show',
                    ]),
                Tables\Columns\TextColumn::make('loyalty_points_awarded')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'booked' => 'Booked',
                        'cancelled' => 'Cancelled',
                        'completed' => 'Completed',
                        'no_show' => 'No Show',
                    ]),
                Tables\Filters\Filter::make('upcoming')
                    ->query(fn ($query) => $query->upcoming()),
                Tables\Filters\Filter::make('past')
                    ->query(fn ($query) => $query->past()),
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}