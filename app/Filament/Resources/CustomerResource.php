<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages;
use App\Filament\Resources\CustomerResource\RelationManagers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static  ?string $navigationGroup="Manage";
    protected static  ?string $navigationLabel="Manage Customers";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Section::make('General')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                        ->label('Name')
                        ->required(),
                        Forms\Components\TextInput::make('mobile_no')
                        ->label('Phone')
                        ->required(),
                        Forms\Components\TextInput::make('email')
                        ->label('Email Address'),
                    ])->columns(2),
                    Forms\Components\Section::make('')
                    ->schema([
                        Forms\Components\MarkdownEditor::make('address')
                            ->label('Customer Address')
                            ->required()
                            ->columnSpanFull(),
//                        Forms\Components\RichEditor::make('address')

                    ]),
//                    Forms\Components\Section::make('Cucstomer Address')
//                        ->schema([
//                            Forms\Components\Textarea::make('address')
////                            ->label('Cucstomer Address')
//                                ->required()
//                                ->columnSpanFull(),
//
//
//                        ]),

                ]),
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Section::make('Photo')
                            ->schema([
                                Forms\Components\FileUpload::make('customer_image')
                                ->label('')
                            ])->collapsible()
                    ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                ->label('Name')
                ,
                Tables\Columns\ImageColumn::make('customer_image')
                    ->label('Customer Photo'),
                Tables\Columns\TextColumn::make('mobile_no')
                    ->searchable()
                    ->sortable()
                ->label('Phone')
                ,
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label('Email')
                ,
                Tables\Columns\TextColumn::make('address')
                    ->searchable()
                    ->label('Address')
                    ->sortable()
                ,
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\ViewAction::make(),
                ])
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
