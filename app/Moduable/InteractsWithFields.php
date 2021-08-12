<?php


namespace App\Moduable;
use App\Models\Field;

trait InteractsWithFields
{
    public function fields(){
        return $this->hasMany(Field::class);
    }
}
