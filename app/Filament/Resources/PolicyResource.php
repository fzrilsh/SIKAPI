<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PolicyResource\Pages;
use App\Filament\Resources\PolicyResource\RelationManagers;
use App\Models\Policy;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\HtmlString;

class PolicyResource extends Resource
{
    protected static ?string $model = Policy::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Kebijakan Publik';

    protected static ?string $modelLabel = 'Kebijakan';

    protected static ?string $pluralModelLabel = 'Daftar Kebijakan';

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        if (!Auth::user()->is_super_admin) {
            $query->where('ministry_id', Auth::user()->ministry_id);
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Utama')
                    ->schema([
                        Hidden::make('ministry_id')
                            ->default(fn() => Auth::user()->ministry_id),
                        TextInput::make('title')
                            ->label('Judul Kebijakan / RUU')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        TextInput::make('slug')
                            ->required()
                            ->disabled()
                            ->dehydrated()
                            ->unique(Policy::class, 'slug', ignoreRecord: true),
                        Textarea::make('summary')
                            ->label('Ringkasan Eksekutif')
                            ->required()
                            ->rows(4)
                            ->columnSpanFull(),
                    ])->columns(2),
                Section::make('Pengaturan Publikasi')
                    ->schema([
                        Select::make('status')
                            ->options([
                                'draft' => 'Pengumpulan Draft',
                                'public_evaluation' => 'Evaluasi Publik',
                                'under_review' => 'Dalam Tinjauan',
                                'approved' => 'Disetujui',
                                'needs_revision' => 'Butuh Revisi',
                            ])
                            ->required()
                            ->default('draft')
                            ->native(false),
                        DatePicker::make('deadline_date')
                            ->label('Batas Akhir Partisipasi Publik')
                            ->required(),
                        TextInput::make('document_url')
                            ->label('URL Dokumen Draf (Link PDF/Drive)')
                            ->url()
                            ->columnSpanFull(),
                    ])->columns(2),
                Section::make('Poin-Poin Utama Kebijakan')
                    ->description('Poin ini akan ditampilkan dalam bentuk Bento Grid di halaman detail SIKAPI.')
                    ->schema([
                        Repeater::make('points')
                            ->relationship()
                            ->schema([
                                TextInput::make('icon')
                                    ->label('Material Symbols Icon')
                                    ->placeholder('contoh: shield_person')
                                    ->required()
                                    ->helperText(new HtmlString('Cari referensi nama icon di <a href="https://fonts.google.com/icons?icon.set=Material+Icons" target="_blank" style="text-decoration: underline; color: #ed8936;">Google Material Icons</a>.')),

                                TextInput::make('title')
                                    ->label('Judul Poin')
                                    ->required(),

                                Textarea::make('description')
                                    ->label('Penjelasan Singkat')
                                    ->required()
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->addActionLabel('Tambah Poin Baru')
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Judul Kebijakan')
                    ->searchable()
                    ->wrap()
                    ->weight('bold'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'public_evaluation' => 'info',
                        'under_review' => 'warning',
                        'approved' => 'success',
                        'needs_revision' => 'danger',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'draft' => 'Pengumpulan Draft',
                        'public_evaluation' => 'Evaluasi Publik',
                        'under_review' => 'Dalam Tinjauan',
                        'approved' => 'Disetujui',
                        'needs_revision' => 'Butuh Revisi',
                    }),
                TextColumn::make('deadline_date')
                    ->label('Tenggat')
                    ->date('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Pengumpulan Draft',
                        'public_evaluation' => 'Evaluasi Publik',
                        'under_review' => 'Dalam Tinjauan',
                        'approved' => 'Disetujui',
                        'needs_revision' => 'Butuh Revisi',
                    ]),
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
            'index' => Pages\ListPolicies::route('/'),
            'create' => Pages\CreatePolicy::route('/create'),
            'edit' => Pages\EditPolicy::route('/{record}/edit'),
        ];
    }
}
