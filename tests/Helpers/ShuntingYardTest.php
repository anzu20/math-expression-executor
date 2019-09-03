<?php

use MathExpressionExecutor\Helpers\ShuntingYard;
use PHPUnit\Framework\TestCase;
use MathExpressionExecutor\Exceptions\FormatException;

class ShuntingYardTest extends TestCase
{
    public function testCanProduceSimpleExpression()
    {
        $parser = new ShuntingYard();
        $this->assertEquals("22+", $parser->getRPN("2+2"));
    }

    public function testCanProduceTwoOperatorExpression()
    {
        $parser = new ShuntingYard();
        $this->assertEquals("22+2+", $parser->getRPN("2+2+2"));
        $this->assertEquals("22*2*", $parser->getRPN("2*2*2"));
    }

    public function testCanProduceSimpleParenthesisExpression()
    {
        $parser = new ShuntingYard();
        $this->assertEquals("11+", $parser->getRPN("(1+1)"));
    }

    public function testCanProduceMultipleParenthesisExpression()
    {
        $parser = new ShuntingYard();
        $this->assertEquals("11+22+*", $parser->getRPN("(1+1)*(2+2)"));
    }

    public function testCannotProduceInvalidExpression()
    {
        $this->expectException(FormatException::class);
        $parser = new ShuntingYard();
        $parser->getRPN("a3+1");
    }

    public function testCannotProduceInvalidOpenBracketsUseExpression()
    {
        $this->expectException(FormatException::class);
        $this->expectExceptionMessage('Invalid brackets use');
        $parser = new ShuntingYard();
        $parser->getRPN("((1+1)");
    }

    public function testCannotProduceInvalidCloseBracketsUseExpression()
    {
        $this->expectException(FormatException::class);
        $this->expectExceptionMessage('Invalid brackets use');
        $parser = new ShuntingYard();
        $parser->getRPN("(1+1))");
    }
}