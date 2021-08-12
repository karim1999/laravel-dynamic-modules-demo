<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Record;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Mod;

class TestController extends Controller
{
    //
    public function index(){
//        $service2= Module::createModule('AC- Split Unit');
//        $service1= Module::with(['records'])->findOrFail(1);
        $records= Record::whereField('eos', 'changed')->get();
//        $service1->records()->save($record);
//        $record= Record::with('fields')->findOrFail(4);
//        $module= Module::with('records')->findOrFail(1);

//        $modules= Module::all();
//        $module= Module::findOrFail(1);
//        $record= Record::with('fields')->findOrFail(2);
//        $record->syncFieldsWithNames([
//            'eos' => 'changed',
//            'debitis' => 'asdasd',
//        ]);


        return [
//            "fields" => $record->availableFields,
            "record" => $records
//            "record" => $record,
//            "service" => $service1,
//            'tempore' => $record->getField('aliquam'),
//            'modules' => $modules,
//            'module' => $module,
//            'fields' => $record->availableFields()->where('fields.name', 'tempore')->get(),
//            'record' => $record->availableFields,
//            'records' => Record::orderByField('est', 'desc')->get()
        ];
    }
}
