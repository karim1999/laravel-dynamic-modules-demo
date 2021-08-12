<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;

    protected $fillable= [
        'rule',
        'value',
        'field_id',
        'extra'
    ];

    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
