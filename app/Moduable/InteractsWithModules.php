<?php


namespace App\Moduable;


use App\Models\Module;

trait InteractsWithModules
{
    public function modules(){
        return $this->hasMany(Module::class);
    }
}
