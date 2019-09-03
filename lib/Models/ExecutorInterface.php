<?php
namespace MathExpressionExecutor\Models;

/**
 * Interface ExecutorInterface
 * @package MathExpressionExecutor\Models
 */
interface ExecutorInterface
{
    /**
     * Calculates given expression
     * @param string $expression
     * @return mixed
     */
    public function calculate(string $expression);
}