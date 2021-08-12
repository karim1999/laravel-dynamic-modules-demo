<?php


namespace App\Moduable;
use App\Models\Rule;

trait InteractsWithRules
{
    public function rules(){
        return $this->hasMany(Rule::class);
    }

    public function getValidationStringAttribute()
    {
        $arr= [];

        foreach ($this->rules as $rule) {
            $str = '';
            if($rule->value)
            {
                $str = $rule->rule.":".$rule->value ;

                if($rule->extra)
                {
                    $str .= ",".$rule->extra;
                }
                $arr[]= $str;

            }

            else{
                $arr[]= $rule->rule;
            }
        }

        return implode("|",$arr);
    }
}
