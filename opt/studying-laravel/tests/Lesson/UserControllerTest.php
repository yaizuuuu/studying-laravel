<?php
/**
 * Created by IntelliJ IDEA.
 * User: yaizuuuu
 * Date: 2018/10/17
 * Time: 20:50
 */

namespace Tests\Lesson;


use App\Eloquent\User;
use Eloquent;
use Mockery;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    protected $user_mock;
    protected $request_mock;

    public function setUp()
    {
        parent::setUp();

        $this->user_mock = Mockery::mock(Eloquent::class, User::class);
        $this->request_mock = Mockery::mock(Request::class)->makePartial();
    }

    public function testIndex()
    {
        $this->user_mock
            ->shouldReceive('all')
            ->once()
            ->andReturn('foo');

        $this->app->instance(User::class, $this->user_mock);

        $response = $this->get('user');
        $response->assertViewHas('users');
    }

    public function testStore()
    {
        $input = ['title' => 'My Title'];

        $this->request_mock
            ->shouldReceive('all')
            ->once()
            ->andReturn($input);

        $this->app->instance(Request::class, $this->request_mock);

        $this->user_mock
            ->shouldReceive('create')
            ->once()
            ->with($input);

        $this->app->instance(User::class, $this->user_mock);

        $response = $this->post('user');

        $response->assertRedirect(route('user.index'));
    }

    public function testStoreFailure()
    {
        $input = ['title' => ''];

        $this->request_mock
            ->shouldReceive('all')
            ->once()
            ->andReturn($input);

        $this->app->instance(Request::class, $this->request_mock);

        $this->app->instance(User::class, $this->user_mock);

        $response = $this->post('user');

        $response->assertRedirect(route('user.create'));
        $response->assertSessionHasErrors(['title']);
    }

    public function testStoreSuccess()
    {
        $input = ['title' => 'My Title'];

        $this->request_mock
            ->shouldReceive('all')
            ->once()
            ->andReturn($input);

        $this->app->instance(Request::class, $this->request_mock);

        $this->user_mock
            ->shouldReceive('create')
            ->once()
            ->with($input);

        $this->app->instance(User::class, $this->user_mock);

        $response = $this->post('user');

        $response->assertRedirect(route('user.index'));
        $response->assertSessionHas('flash');
    }
}
