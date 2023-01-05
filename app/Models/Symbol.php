<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symbol extends Model
{
    protected $fillable = [
        'symbol' ,
        'title'
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
