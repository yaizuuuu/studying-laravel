<?php
/**
 * Created by IntelliJ IDEA.
 * User: yaizuuuu
 * Date: 2018/10/14
 * Time: 13:49
 */

namespace Tests\Lesson;

use Tests\TestCase;
use Mockery;

class MockTest extends TestCase
{
    public function tearDown()
    {
        parent::tearDown();

        Mockery::close();
    }

    public function testItWorks()
    {
//        $user = Mockery::mock(['getFullName' => 'Jeffrey Way']);
//        dd($user->getFullName()); // Jeffrey Way

//         $file = new File();
        $mocked_file = Mockery::mock(File::class)->makePartial();

        $mocked_file->shouldReceive('put')
            ->with('foo.txt', 'foo bar')
            ->once();

//        $generator = new Generator($file);
        $generator = new Generator($mocked_file);

        $generator->fire();
    }

    public function testDoesNotOverwriteFile()
    {
        $mocked_file = Mockery::mock(File::class);

        $mocked_file->shouldReceive('exists')
            ->once()
            ->andReturn(true);

        $mocked_file->shouldReceive('put')
            ->never();

        $generator = new Generator($mocked_file);
        $generator->fire();
    }
}


class Generator
{
    protected $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    public function getContent()
    {
        return 'foo bar';
    }

    public function fire()
    {
        $content = $this->getContent();

        if (!$this->file->exists()) {
            $this->file->put('foo.txt', $content);
        }
    }


}

class File
{
    public function put($path, $content)
    {
        return file_put_contents($path, $content);
    }

    public function exists()
    {
        return false;
    }
}
