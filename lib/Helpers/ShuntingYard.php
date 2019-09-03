<?php
namespace MathExpressionExecutor\Helpers;

use MathExpressionExecutor\Exceptions\FormatException;
use MathExpressionExecutor\Exceptions\UnknownOperatorType;
use MathExpressionExecutor\Exceptions\UnknownTypeException;
use MathExpressionExecutor\Models\Tokens\OperandToken;
use MathExpressionExecutor\Models\Tokens\OperatorToken;
use MathExpressionExecutor\Models\Tokens\ParenthesisToken;
use MathExpressionExecutor\Models\Tokens\Token;

/**
 * Class ShuntingYard
 * Implements shunting-yard algorithm
 * Can produce a postfix notation string, also known as Reverse Polish notation (RPN)
 * @package MathExpressionExecutor\Helpers
 *
 * @property Stack $stack
 */
class ShuntingYard
{
    /**
     * @var Stack
     */
    private $stack;

    /**
     * Produces reverse polish notation by shunting-yard algorithm
     * @param string $expression
     * @return string
     * @throws FormatException
     * @throws UnknownOperatorType
     * @throws UnknownTypeException
     */
    public function getRPN(string $expression)
    {
        $tokens = Parser::tokenize($expression);
        $result = '';
        $this->stack = new Stack();

        /* @var $token Token|OperatorToken|ParenthesisToken */
        // Handle every token
        foreach ($tokens as $token) {
            switch (get_class($token)) {
                case OperandToken::class:
                    //Number goes right to output
                    $result .= $token->getValue();
                    break;
                case OperatorToken::class:
                    $result .= $this->handleOperator($token);
                    break;
                case ParenthesisToken::class:
                    $result .= $this->handleParenthesis($token);
                    break;
                default:
                    throw new UnknownTypeException("Unknown type of token: {$token->getValue()}");
                    break;
            }
        }

        //Pop remaining tokens from stack
        while (!$this->stack->isEmpty()) {
            $element = Parser::getToken($this->stack->pop());
            if ($element instanceof ParenthesisToken) {
                throw new FormatException("Invalid brackets use");
            }
            $result .= $element->getValue();
        }

        return $result;
    }

    /**
     * While there is an operator at the top of the stack with greater or equal precedence
     * and the operator at the top of the stack is not a left parenthesis
     * pop operators from the operator stack onto the output.
     * @param OperatorToken $token
     * @return string
     * @throws FormatException
     * @throws UnknownOperatorType
     */
    private function handleOperator(OperatorToken $token)
    {
        $result = '';
        while (!$this->stack->isEmpty()) {
            $last_token = Parser::getToken($this->stack->lastElement());
            if ($last_token instanceof OperatorToken && $last_token->getPrecedence() >= $token->getPrecedence()) {
                $result .= $this->stack->pop();
            } else {
                break;
            }
        }
        $this->stack->push($token->getValue());
        return $result;
    }

    /**
     * Handling parenthesis token
     * @param ParenthesisToken $token
     * @return string
     * @throws FormatException
     */
    private function handleParenthesis(ParenthesisToken $token)
    {
        $result = '';

        // If the token is a left paren (i.e. "("), then push it onto the operator stack
        if ($token->getValue() === ParenthesisToken::OPEN_BRACKET) {
            $this->stack->push($token->getValue());
        } else {
            // While the operator at the top of the stack is not a left bracket pop the operator from the stack onto the output queue
            while (!empty($last = $this->stack->lastElement()) && $last !== ParenthesisToken::OPEN_BRACKET) {
                $result .= $this->stack->pop();
            }

            // If the stack runs out without finding a left paren, then there are mismatched parentheses
            if ($last !== ParenthesisToken::OPEN_BRACKET) {
                throw new FormatException("Invalid brackets use");
            } else {
                $this->stack->pop();
            }
        }
        return $result;
    }
}