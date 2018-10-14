<?php

namespace Tests\Lesson;

use http\Url;
use Illuminate\Routing\UrlGenerator;
use PHPUnit\Framework\TestCase;

class PracticeTest extends TestCase
{
    public function testHelloWorld()
    {
        $greeting = 'Hello World';

        $this->assertTrue($greeting === 'Hello World', $greeting);
    }

    public function testAdd2_2()
    {
        $sum = 2 + 2;

        $this->assertEquals(4, $sum);
    }

    public function testTryAssertSame()
    {
        $val = 0;

        $this->assertSame(0, $val);
    }

    public function testTryAssertContains()
    {
        $names = ['Taylor', 'Swift', 'Suzuki',];

        $this->assertContains('Taylor', $names);
    }

    public function testTryAssertArrayHasKey()
    {
        $family = [
            'parent' => [
                'Yasuhiro',
                'Hiroko',
            ],
            'children' => [
                'Eri',
                'Yuma',
            ]
        ];

        $this->assertArrayHasKey('parent', $family);
    }

    public function testTryAssertInternalType()
    {
        $integer = 25;

        $this->assertInternalType('integer', $integer);
    }

    public function testTryAssertInstanceOf()
    {
        $date_formatter = new DateFormatter(new \DateTime());

        $this->assertInstanceOf('DateTime', $date_formatter->getStamp());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testTryAnnotation()
    {
        // データを与える (Given)
        $names = ['Taylor', 'Dayle', 'Matthew', 'Shawn', 'Neil'];

        // 異なったキーを指定し
        // 関数を呼び出すとき (When)
        $result = $this->array_until('Bob', $names);

        // その結果 (Then) 例外が投げられるだろう(コメント参照)
    }

    function array_until($stopPoint, $arr)
    {
        $index = array_search($stopPoint, $arr);

        if (false === $index) {
            throw new \InvalidArgumentException('Key does not exist in array');
        }

        return array_slice($arr, 0, $index);
    }

    public function testBuildsAnchorTag()
    {
        $actual = link_to('dogs/1', 'Show Dog');
        $expect = "<a href='http://:/dogs/1'>Show Dog</a>";

        $this->assertEquals($actual, $expect);
    }

    public function testAppliesAttributesUsingArray()
    {
        $actual = link_to('dogs/1', 'Show Dog', ['class' => 'button']);
        $expect = "<a href='http://:/dogs/1' class='button'>Show Dog</a>";

        $this->assertEquals($actual, $expect);
    }
}

Class DateFormatter
{
    protected $stamp;

    public function __construct(\DateTime $stamp)
    {
        $this->stamp = $stamp;
    }

    public function getStamp()
    {
        return $this->stamp;
    }
}

function link_to($path, $body, $attributes = [])
{
    $count = count($attributes);
    $text = '';

    if ($count) {
        foreach ($attributes as $key => $attribute) {
            $text .= " ${key}='${attribute}'";
        }
    }
    $url = app(UrlGenerator::class)->to($path);
    return "<a href='${url}'${text}>${body}</a>";
}
