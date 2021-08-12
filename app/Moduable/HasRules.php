<?php


namespace App\Moduable;

interface HasRules
{
    public function rules();
    public function getValidationStringAttribute();
}
