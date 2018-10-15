<?php
/**
 * Created by IntelliJ IDEA.
 * User: yaizuuuu
 * Date: 2018/10/14
 * Time: 14:57
 */

namespace Tests\Lesson;

use Tests\TestCase;
use Illuminate\Support\Facades\File;

class MockingFacadeTest extends TestCase
{
    public function testCreatesFile()
    {
        File::shouldReceive('put')->once();

        $this->call('GET', 'foo');
    }
}
