<?php
/**
 * Created by IntelliJ IDEA.
 * User: yaizuuuu
 * Date: 2018/10/22
 * Time: 4:45
 */

namespace Tests\Lesson;

use App\Services\ModelGenerator;
use Illuminate\Support\Facades\File;
use Tests\TestCase;

class ModelGeneratorTest extends TestCase
{
    public function testCanGenerateModelUsingTemplate()
    {
        File::shouldReceive('put')
            ->once()
            ->with(
                'app/Eloquent/Foo.php',
                file_get_contents(__DIR__ . '/stubModel.txt')
            );

        $generator = new ModelGenerator();
        $generator->make('app/Eloquent/Foo.php');
    }
}
