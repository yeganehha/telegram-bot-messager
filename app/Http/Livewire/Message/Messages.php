<?php

namespace App\Http\Livewire\Message;

use App\Http\Livewire\DataTableComponent;
use App\Models\Symbol;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Message;

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
        ];
    }
}
