<?php

namespace App\Models;

use App\Moduable\HasRecords;
use App\Moduable\HasRules;
use App\Moduable\InteractsWithRecords;
use App\Moduable\InteractsWithRules;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model implements HasRecords, HasRules
{
    use HasFactory, InteractsWithRecords, InteractsWithRules;

    protected $fillable= [
        'name',
        'label',
        'type',
        'position',
        'model_id',
        'extra'
    ];

    protected $casts = [
        'extra' => AsCollection::class,
    ];

    protected $appends=["validation_string"];
    protected $with=["rules"];

    public function records(){
        return $this->belongsToMany(Record::class)->withPivot(['value']);
    }

    public function fieldImplementationClass(){
        return config('fields.implementations'.$this->type) ?? config('fields.defaultImplementation');
    }
}
