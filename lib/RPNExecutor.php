<?php
namespace MathExpressionExecutor;

use MathExpressionExecutor\Exceptions\FormatException;
use MathExpressionExecutor\Exceptions\UnknownTypeException;
use MathExpressionExecutor\Helpers\ShuntingYard;
use MathExpressionExecutor\Helpers\Stack;
use MathExpressionExecutor\Helpers\Parser;
use MathExpressionExecutor\Models\ExecutorInterface;
use MathExpressionExecutor\Models\Tokens\OperandToken;
use MathExpressionExecutor\Models\Tokens\OperatorToken;
use MathExpressionExecutor\Models\Tokens\Token;

/**
 * Class RPNExecutor
 * RPNExecutor uses Reverse Polish notation (RPN) obtained after shunting-yard algorithm to execute expression
 * @package MathExpressionExecutor
 */
class RPNExecutor implements ExecutorInterface
{
    /**
     * Calculates given expression
     * @param string $expression
     * @return mixed
     * @throws Exceptions\UnknownOperatorType
     * @throws FormatException
     * @throws UnknownTypeException
     */
    public function calculate(string $expression)
    {
        $parser = new ShuntingYard();
        $rpn = $parser->getRPN($expression);
        return $this->executeRPN($rpn);
    }

    /**
     * @param string $expression
     * @return mixed
     * @throws Exceptions\UnknownOperatorType
     * @throws FormatException
     * @throws UnknownTypeException
     */
    private function executeRPN(string $expression)
    {
        $tokens = Parser::tokenize($expression);
        $stack = new Stack();

        /* @var $token Token */
        foreach ($tokens as $token) {
            switch (get_class($token)) {
                case OperandToken::class:
                    $stack->push((int) $token->getValue());
                    break;
                case OperatorToken::class:
                    /* @var $token OperatorToken */
                    $first_operand = $stack->pop();
                    $second_operand = $stack->pop();
                    if (is_int($first_operand) && is_int($second_operand)) {
                        $stack->push($token->process($first_operand, $second_operand));
                    } else {
                        throw new FormatException("Invalid expression");
                    }
                    break;
                default:
                    throw new UnknownTypeException("Unknown type of token: {$token->getValue()}");
                    break;
            }
        }
        $result = $stack->pop();
        if (!$stack->isEmpty()) {
            throw new FormatException("Invalid expression");
        }
        return $result;
    }
}