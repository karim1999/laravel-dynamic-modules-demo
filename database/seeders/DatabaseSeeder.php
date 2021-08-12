<?php

namespace Database\Seeders;

use App\Models\Field;
use App\Models\Module;
use App\Models\Record;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $modules= Module::factory(1)
             ->has(Record::factory()->count(3)->hasAttached(Field::factory(3)->state(new Sequence(function (){
                 return ['module_id' => 1];
             })), ['value' => "test"]))
             ->create();

    }
}
