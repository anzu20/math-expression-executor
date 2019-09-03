<?php
namespace MathExpressionExecutor\Models\Tokens;

/**
 * Class Token
 * Represents single character (token) from expression
 * @package MathExpressionExecutor\Models\Tokens
 *
 * @property $value string
 */
abstract class Token
{
    /**
     * @var string Value
     */
    protected $value;

    /**
     * Token constructor.
     * @param string $chr
     */
    public function __construct(string $chr)
    {
        $this->value = $chr;
    }

    /**
     * Returns token value
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}