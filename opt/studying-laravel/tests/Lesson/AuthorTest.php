<?php
/**
 * Created by IntelliJ IDEA.
 * User: yaizuuuu
 * Date: 2018/10/13
 * Time: 22:23
 */

namespace Tests\Lesson;

use App\Eloquent\Author;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Helper\ModelHelpers;
use Tests\TestCase;

class AuthorTest extends TestCase
{
    use RefreshDatabase;
    use ModelHelpers;

    public function testInvalidNotUniqueEmail()
    {
        $author = new Author();
        $author->name = 'Joe';
        $author->email = 'yaizu@yaizuuuu.com';
        $author->save();

        $author = new Author();
        $author->name = 'Ken';
        $author->email = 'yaizu@yaizuuuu.com';
        $author->save();

        $result = $author->validate();

        $this->assertFalse($result, 'バリデーション失敗を期待する');
    }

    public function testInvalidWithoutNameAndEmail()
    {
        $author = new Author();

        $this->assertInvalidModel($author);
    }

    public function testInvalidNotUniqueEmailFactory()
    {
        $author = factory(Author::class)->create([
            'email' => 'yaizu@yaizuuuu.com'
        ]);

        $author = factory(Author::class)->create([
            'email' => 'yaizu@yaizuuuu.com'
        ]);

        $this->assertInvalidModel($author);
    }
}
