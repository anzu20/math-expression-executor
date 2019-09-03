<?php
namespace MathExpressionExecutor\Helpers;

/**
 * Class Stack
 * @package MathExpressionExecutor\Helpers
 *
 * @property $elements array
 */
class Stack
{
    /**
     * Stack array
     * @var array
     */
    private $elements = [];

    /**
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->elements);
    }

    /**
     * Return last element of stack
     * @return mixed
     */
    public function lastElement()
    {
        return end($this->elements);
    }

    /**
     * Push element in stack
     * @param $element
     */
    public function push($element)
    {
        $this->elements[] = $element;
    }

    /**
     * Pop element in stack
     * @return mixed
     */
    public function pop()
    {
        return array_pop($this->elements);
    }
}