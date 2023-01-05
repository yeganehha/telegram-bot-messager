<?php

namespace App\Http\Livewire\Symbol;

use App\Http\Livewire\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Symbol;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class Symbols extends DataTableComponent
{
    protected $model = Symbol::class;
    public $addRoute = 'currency.edit';
    public $title = "Currencies";

    public function columns(): array
    {
        return [
            Column::make("ID", "id")
                ->hideIf(true),
            Column::make("Title", "title")
                ->searchable()
                ->sortable(),
            Column::make("Symbol", "symbol")
                ->searchable()
                ->sortable(),
            ButtonGroupColumn::make('Actions')
                ->attributes(function($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'Edit' )
                        ->location(fn($row) => route('currency.edit', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-outline-warning',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'Messages' )
                        ->location(fn($row) => route('messages', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-outline-info',
                            ];
                        }),
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'Send New' )
                        ->location(fn($row) => route('message.create', $row))
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-outline-success',
                            ];
                        }),
                ]),
        ];
    }
}
