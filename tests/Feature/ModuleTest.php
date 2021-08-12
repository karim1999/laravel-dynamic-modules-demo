<?php

namespace Tests\Feature;

use App\Models\Module;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ModuleTest extends TestCase
{
//    use DatabaseTransactions;

    /**
     * A module test example with correct data.
     *
     * @return void
     */
    public function test_module_successful_creation()
    {
        $postModule= Module::createModule('post');
        $commentModule= Module::createModule('comment', ["test" => "hi"]);
        $videoModule= Module::createModule('video', null);

        $this->assertDatabaseCount('modules', 3);
        $this->assertEquals('hi', $commentModule->extra["test"]);
    }
}
