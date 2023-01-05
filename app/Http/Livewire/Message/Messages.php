<?php

namespace App\Http\Livewire\Message;

use App\Http\Livewire\DataTableComponent;
use App\Models\Symbol;
use HackerESQ\Settings\Facades\Settings;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Message;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class Messages extends DataTableComponent
{
    protected $model = Message::class;

    public $title = "";
    public $symbol;
    public $backRoute = 'currency' ;

    public function mount(Symbol $symbol)
    {
        $this->symbol = $symbol;
        $this->title = $symbol->title . " (".$symbol->symbol.") Message";
        $this->addRoute = ['message.create' , $this->symbol];
    }

    function builder(): Builder
    {
        return $this->symbol->messages()->getQuery();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
            Column::make("telegram_id", "telegram_id")
                ->hideIf(true),
            Column::make("Symbol id", "symbol_id")
                ->hideIf(true),
            Column::make("Position", "position")
                ->format(fn($value , $row) => Message::position_label($value))
                ->searchable()
                ->sortable(),
            Column::make("Target", "target")
                ->searchable()
                ->sortable(),
            Column::make("Stop", "stop")
                ->searchable()
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),

            ButtonGroupColumn::make('Actions')
                ->attributes(function($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Edit Message')
                        ->title(fn($row) => '✏ Edit Message' )
                        ->location(fn($row) =>  route('message.create', [$this->symbol ,  $row]))
                        ->attributes(function($row) {
                            return [
                                'class' => 'btn btn-outline-warning',
                            ];
                        }),
                        LinkColumn::make('On telegram')
                            ->title(fn($row) => '👁️‍🗨️ On telegram' )
                            ->location(fn($row) => Settings::get('channel_link') .$row->telegram_id)
                            ->attributes(function($row) {
                                return [
                                    'class' => 'btn btn-outline-info',
                                ];
                            }),
                        LinkColumn::make('delete Message')
                            ->title(fn($row) => '🗑️ Delete' )
                            ->location(fn($row) => route('message.delete', [$this->symbol ,  $row]) )
                            ->attributes(function($row) {
                                return [
                                    'class' => 'btn btn-outline-danger',
                                ];
                            }),
                    ]),
        ];
    }
}
