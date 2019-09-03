<?php
namespace MathExpressionExecutor;

use MathExpressionExecutor\Exceptions\MathExpressionException;
use MathExpressionExecutor\Models\ExecutorInterface;

/**
 * Class ASTExecutor
 * ASTExecutor uses an abstract syntax tree obtained after shunting-yard algorithm to execute expression
 * @package MathExpressionExecutor
 */
class ASTExecutor implements ExecutorInterface
{
    /**
     * @param string $expression
     * @throws MathExpressionException
     */
    public function calculate(string $expression)
    {
        throw new MathExpressionException("Method is not yet implemented");
    }
}