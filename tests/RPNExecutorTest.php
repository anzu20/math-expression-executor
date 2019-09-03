<?php

use PHPUnit\Framework\TestCase;
use MathExpressionExecutor\Exceptions\FormatException;
use MathExpressionExecutor\RPNExecutor;

class RPNExecutorTest extends TestCase
{
    public function testCanCalculateSimpleExpression(): void
    {
        $executor = new RPNExecutor();
        $this->assertEquals(4, $executor->calculate("2+2"));
    }

    public function testCanProduceTwoOperatorExpression(): void
    {
        $executor = new RPNExecutor();
        $this->assertEquals("6", $executor->calculate("2+2+2"));
        $this->assertEquals("8", $executor->calculate("2*2*2"));
    }

    public function testCanProduceSimpleParenthesisExpression(): void
    {
        $executor = new RPNExecutor();
        $this->assertEquals("2", $executor->calculate("(1+1)"));
    }

    public function testCanProduceMultipleParenthesisExpression(): void
    {
        $executor = new RPNExecutor();
        $this->assertEquals("8", $executor->calculate("(1+1)*(2+2)"));
    }

    public function testCannotProduceInvalidExpression(): void
    {
        $this->expectException(FormatException::class);
        $executor = new RPNExecutor();
        $executor->calculate("**3");
    }
}