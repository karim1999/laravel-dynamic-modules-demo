<?php

namespace App\Models;

use App\Moduable\HasFields;
use App\Moduable\HasRules;
use App\Moduable\HasRecords;
use App\Moduable\InteractsWithFields;
use App\Moduable\InteractsWithRules;
use App\Moduable\InteractsWithRecords;
use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model implements HasRules, HasRecords, HasFields
{
    use HasFactory, InteractsWithRules, InteractsWithRecords, InteractsWithFields;

    protected $fillable= [
        'name',
        'extra'
    ];

    protected $casts = [
        'extra' => AsCollection::class,
    ];

    public static function createModule($name, $extra=[]){
        $data= [
            'name' => $name,
            'extra' => $extra,
        ];

        return static::create($data);
    }
}
