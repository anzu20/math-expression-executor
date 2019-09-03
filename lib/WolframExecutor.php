<?php
namespace MathExpressionExecutor;

use MathExpressionExecutor\Exceptions\MathExpressionException;
use MathExpressionExecutor\Models\ExecutorInterface;

/**
 * Class WolframExecutor
 * WolframExecutor uses WolframAlfa to execute expression
 * @package MathExpressionExecutor
 */
class WolframExecutor implements ExecutorInterface
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