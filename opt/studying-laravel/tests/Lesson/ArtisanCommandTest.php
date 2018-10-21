<?php
/**
 * Created by IntelliJ IDEA.
 * User: yaizuuuu
 * Date: 2018/10/22
 * Time: 3:02
 */

namespace Tests\Lesson;


use App\Services\ModelGenerator;
use Tests\TestCase;
use Mockery;

class ArtisanCommandTest extends TestCase
{
//    public function tearDown()
//    {
//        parent::tearDown();
//        Mockery::close();
//    }

//    public function testOutput()
//    {
//        $this->artisan('command:createUser', ['user' => ['yaizu', 'yaizuuuu']])
//            ->expectsOutput('yaizu,yaizuuuu')
//            ->assertExitCode(0);
//    }

    public function testGeneratesModelSuccessfully()
    {
        $mock = Mockery::mock(ModelGenerator::class);

        $mock->shouldReceive('make')
            ->once()
            ->with('app/Eloquent/Foo.php')
            ->andReturn(true);

        $this->app->instance(ModelGenerator::class, $mock);

        $this->artisan('command:generateModel', ['name' => 'foo'])
            ->expectsOutput('Created app/Eloquent/Foo.php')
            ->assertExitCode(0);
    }

    public function testAlertsUserIfModelGenerationFails()
    {
        $mock = Mockery::mock(ModelGenerator::class);

        $mock->shouldReceive('make')
            ->once()
            ->with('app/Eloquent/Foo.php')
            ->andReturn(false);

        $this->app->instance(ModelGenerator::class, $mock);

        $this->artisan('command:generateModel', ['name' => 'foo'])
            ->expectsOutput('Could not create app/Eloquent/Foo.php')
            ->assertExitCode(0);
    }

    public function testCustomPath()
    {
        $mock = Mockery::mock(ModelGenerator::class);

        $mock->shouldReceive('make')
            ->once()
            ->with('app/Models/Foo.php')
            ->andReturn(true);

        $this->app->instance(ModelGenerator::class, $mock);

        $this->artisan(
            'command:generateModel',
            [
                'name' => 'foo',
                '--path' => 'app/Models'
            ])
            ->expectsOutput('Created app/Models/Foo.php')
            ->assertExitCode(0);
    }
}
