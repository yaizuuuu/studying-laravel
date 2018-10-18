<?php
/**
 * Created by IntelliJ IDEA.
 * User: yaizuuuu
 * Date: 2018/10/17
 * Time: 20:50
 */

namespace Tests\Lesson;


use App\Eloquent\User;
use App\Repositories\User\UserRepositoryInterface;
use Mockery;
use Illuminate\Http\Request;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    private function mock(string $class)
    {
        $mock = Mockery::mock($class);

        $this->app->instance($class, $mock);

        return $mock;
    }

    private function requestMock($input)
    {
        $this->mock(Request::class)
            ->makePartial()
            ->shouldReceive('all')
            ->once()
            ->andReturn($input);
    }

    public function testIndex()
    {
        User::shouldReceive('all')
            ->once()
            ->andReturn('foo');

        $response = $this->get('user');
        $response->assertViewHas('users');
    }

    public function testStore()
    {
        $input = ['title' => 'My Title'];

        $this->requestMock($input);

        User::shouldReceive('create')
            ->once()
            ->with($input);

        $response = $this->post('user');

        $response->assertRedirect(route('user.index'));
    }

    public function testStoreFailure()
    {
        $input = ['title' => ''];

        $this->requestMock($input);

        $response = $this->post('user');

        $response->assertRedirect(route('user.create'));
        $response->assertSessionHasErrors(['title']);
    }

    public function testStoreSuccess()
    {
        $input = ['title' => 'My Title'];

        $this->requestMock($input);

        User::shouldReceive('create')
            ->once()
            ->with($input);

        $response = $this->post('user');

        $response->assertRedirect(route('user.index'));
        $response->assertSessionHas('flash');
    }
}
