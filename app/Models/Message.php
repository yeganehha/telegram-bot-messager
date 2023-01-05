<?php

namespace App\Models;

use HackerESQ\Settings\Facades\Settings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'symbol_id',
        'position',
        'target',
        'tp1',
        'tp2',
        'tp3',
        'stop',
        'description',
        'signature',
        'message',
        'telegram_id',
    ];

    public function symbol()
    {
        return $this->belongsTo(Symbol::class);
    }

    public static function position_label($type)
    {
        if ( $type == "sell" )
            return Settings::get('sell_label' , '🔴');
        return Settings::get('buy_label' , '🟢');
    }
}
