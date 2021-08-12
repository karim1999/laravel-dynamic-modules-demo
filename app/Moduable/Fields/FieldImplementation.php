<?php


namespace App\Moduable\Fields;


class FieldImplementation
{

    private $price = 0;
    private $field;

    public function __construct($field)
    {
        $this->field= $field;
        if ($field->extra) {
            $this->price= $field->extra->price;
        }
    }

    public function calculatePrice(){
        return $this->price ?? 0;
    }

}
