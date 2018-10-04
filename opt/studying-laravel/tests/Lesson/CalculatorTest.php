<?php

namespace Tests\Unit\Lesson;

use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    protected $calc;

    public function setUp()
    {
        $this->calc = new Calculator();
    }

    public function testResultDefaultToZero()
    {
        $this->assertSame(0, $this->calc->getResult());
    }

    public function testAddsNumbers()
    {
        $this->calc->setOperands(5);
        $this->calc->setOperation(new Addition());
        $this->calc->calculate();
        $this->assertSame(5, $this->calc->getResult());
    }

    public function testSubtractsNumbers()
    {
        $this->calc->setOperands(5);
        $this->calc->setOperation(new Subtraction());
        $this->calc->calculate();
        $this->assertSame(-5, $this->calc->getResult());
    }

    public function testAcceptsMultipleArgs()
    {
        $this->calc->setOperands(1, 2, 3, 4);
        $this->calc->setOperation(new Addition());
        $this->calc->calculate();
        $this->assertSame(10, $this->calc->getResult());
    }

    public function testMultipliesNumbers()
    {
        $this->calc->setOperands(1);
        $this->calc->setOperation(new Addition());
        $this->calc->calculate();

        $this->calc->setOperands(2, 3, 5);
        $this->calc->setOperation(new Multiplication());
        $this->calc->calculate();
        $this->assertSame(30, $this->calc->getResult());

    }

    public function testTryToUseMokey()
    {
        $mock = \Mockery::mock('Addtion');

        $mock->shouldReceive('run')
            ->once()
            ->with(5, 0)
            ->andReturn(5);

        $this->calc->setOperands(5);
        $this->calc->setOperation($mock);
        $this->calc->calculate();

        $this->assertSame(5, $this->calc->getResult());
    }

    public function testFindsTheSumOfNumbers()
    {
        $add = new Addition();
        $result = $add->run(5, 0);

        $this->assertSame(5, $result);
    }
}

interface Operation
{

    /**
     * @param int $num
     * @param int $current
     * @return int
     */
    public function run(int $num, int $current): int;
}

class Addition implements Operation
{
    public function run(int $num, int $current): int
    {
        return $num + $current;
    }
}

class Subtraction implements Operation
{
    public function run(int $num, int $current): int
    {
        return $current - $num;
    }
}

class Multiplication implements Operation
{
    public function run(int $num, int $current): int
    {
        return $current * $num;
    }
}

class Calculator
{
    protected $result = 0;
    protected $operands = [];
    protected $operation;

    /**
     * @return int
     */
    public function getResult(): int
    {
        return $this->result;
    }

    /**
     * @param mixed $operation
     */
    public function setOperation($operation): void
    {
        $this->operation = $operation;
    }

    /**
     *
     */
    public function setOperands(): void
    {
        $this->operands = func_get_args();
    }

    public function calculate()
    {
        foreach ($this->operands as $operand) {
            $this->result = $this->operation->run($operand, $this->result);
        }
    }
}
