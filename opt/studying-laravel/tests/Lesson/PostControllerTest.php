<?php
/**
 * Created by IntelliJ IDEA.
 * User: yaizuuuu
 * Date: 2018/10/14
 * Time: 15:19
 */

namespace Tests\Lesson;

use App\Eloquent\User;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    public function testIndex()
    {
        factory(User::class, 2)->create();
        $user = User::find(1);

        $response = $this->get('find_user');

        // レスポンスに渡される変数の中身も指定する場合は第2引数を使う
        $response->assertViewHas('find_user', $user);

        // getData() は、レスポンスに付加されている全変数を返す。
        $response_data = $response->original->getData()['find_users'];
        $this->assertInstanceOf(Collection::class, $response_data);
    }
}
