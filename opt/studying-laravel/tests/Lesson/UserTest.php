<?php
/**
 * Created by IntelliJ IDEA.
 * User: yaizuuuu
 * Date: 2018/09/30
 * Time: 20:39
 */

namespace Tests\Unit\Lesson;


use App\Eloquent\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserAgeMutator()
    {
        $user = new User();

        $user->age = 20;

        $this->assertSame('adult', $user->young_or_adult);
    }

    public function testUserOtherPasswordMutator()
    {
        \Hash::shouldReceive('make')->once()->andReturn('hashed');

        $user = new User();
        $user->other_password = 'foo';

        $this->assertSame('hashed', $user->other_password);
    }

    public function testUserInfo()
    {
        $user = new User();
        $user->name = 'yaizuuuu';
        $user->email = 'yaizuuuu@yaizuuuu.com';

        $this->assertSame('yaizuuuu : yaizuuuu@yaizuuuu.com', $user->info());
    }

    public function testFirstYaizuuuuNameUser()
    {
        $index = 0;

        $users = factory(User::class, 3)->create()
            ->each(function ($user) use (&$index) {
                $name = ['yaizuuuu', 'yaizu', 'yaizuu',];
                $user->name = $name[$index++];
                $user->save();
            });

        $actual = (new User)->firstYaizuuuuNameUser();

        $this->assertSame('yaizuuuu', $actual->name);
    }
}
