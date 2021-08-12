<?php


namespace App\Moduable;
use App\Models\Record;

trait InteractsWithRecords
{
    public function records(){
        return $this->hasMany(Record::class);
    }
}
