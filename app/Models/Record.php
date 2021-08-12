<?php

namespace App\Models;

use App\Moduable\Fields\FieldImplementation;
use App\Moduable\HasRecords;
use App\Moduable\InteractsWithRules;
use App\Moduable\InteractsWithRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model implements HasRecords
{
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
    use HasFactory, InteractsWithRecords, InteractsWithRules;

    public function module(){
        return $this->belongsTo(Module::class);
    }

    public function fields()
    {
        return $this->belongsToMany(Field::class)->withPivot(['value']);
    }

    public function availableFields()
    {
        return $this->hasManyDeepFromRelations($this->module(), (new Module)->fields());
    }

    public function syncFields($fields, $column, $remove= true){
        if(!$fields || !is_array($fields))
            return;

        $nameArr= array_keys($fields);
        $modelFields= $this->availableFields()->whereIn('fields.'.$column, $nameArr)->get();

        $newRecordsArr= [];
        foreach ($modelFields as $field){
            $newRecordsArr[$field->id]= ['value' => $fields[$field->name]];
        }

        if($remove){
            $this->fields()->sync($newRecordsArr);
        }else{
            $this->fields()->detach($newRecordsArr);
            $this->fields()->attach($newRecordsArr);
        }
    }
    public function syncFieldsWithNames($fields, $remove= true){
        return $this->syncFields($fields, 'name', $remove);
    }
    public function syncFieldsWithIds($fields, $remove= true){
        return $this->syncFields($fields, 'id', $remove);
    }

    public function whereFieldCommon($query, $name, $operator, $value){
        return $query->whereHas('fields', function (Builder $query) use ($name, $operator, $value) {
            return $query->where(function ($query) use ($name){
                return $query->where('name', $name)->orWhere('fields.id', $name);
            })->where('value', $operator, $value);
        });
    }

    public function scopeWhereField($query, $name, $operator= "=", $value= null)
    {
        return $query->where(function ($query) use ($name, $operator, $value){
            return $this->whereFieldCommon($query, $name, $operator, $value);
        });
    }
    public function scopeOrWhereField($query, $name, $operator= "=", $value= null)
    {
        return $query->orWhere(function ($query) use ($name, $operator, $value){
            return $this->whereFieldCommon($query, $name, $operator, $value);
        });
    }

    public function scopeOrderByField($query, $name, $direction = 'asc'){
        return $query->withCount(['fields as value_order' => function ($query) use($name) {
            $query->select('field_record.value')->where('fields.name', $name)->orWhere('fields.id', $name);
        }])->orderBy('value_order', $direction);
    }

    public function getField($value){
        return $this->fields()->where('name', $value)->orWhere('fields.id', $value)->first();
    }
}
