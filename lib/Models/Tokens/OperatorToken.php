<?php
namespace MathExpressionExecutor\Models\Tokens;

use MathExpressionExecutor\Exceptions\FormatException;
use MathExpressionExecutor\Exceptions\UnknownOperatorType;

/**
 * Class OperatorToken
 * Represents operators: + - / *
 * @package MathExpressionExecutor\Models\Tokens
 *
 * @property $type string
 * @property $precedence int
 */
class OperatorToken extends Token
{
    /**
     * @var int Precedence
     */
    private $precedence;

    /**
     * @var string Type
     */
    private $type;

    const SYMBOLS = ['+', '-', '/', '*'];

    const ADD_TYPE = 'sum';
    const SUB_TYPE = 'sub';
    const MULTIPLICATION_TYPE = 'multiple';
    const DIVISION_TYPE = 'div';

    /**
     * OperatorToken constructor.
     * @param string $chr
     * @throws UnknownOperatorType
     */
    public function __construct(string $chr)
    {
        parent::__construct($chr);

        switch ($chr) {
            case '+':
                $this->type = self::ADD_TYPE;
                $this->precedence = 1;
                break;
            case '-':
                $this->type = self::SUB_TYPE;
                $this->precedence = 1;
                break;
            case '*':
                $this->type = self::MULTIPLICATION_TYPE;
                $this->precedence = 2;
                break;
            case '/':
                $this->type = self::DIVISION_TYPE;
                $this->precedence = 2;
                break;
            default:
                throw new UnknownOperatorType();
        }
    }

    /**
     * Returns operator precedence
     * @return mixed
     */
    public function getPrecedence()
    {
        return $this->precedence;
    }

    /**
     * Returns operator type
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Performs binary operation
     * @param int $first
     * @param int $second
     * @return int
     * @throws FormatException
     * @throws UnknownOperatorType
     */
    public function process(int $first, int $second)
    {
        switch ($this->type) {
            case self::ADD_TYPE:
                return $first + $second;
            case self::SUB_TYPE:
                return $second - $first;
            case self::MULTIPLICATION_TYPE:
                return $first * $second;
            case self::DIVISION_TYPE:
                if ($first === 0) {
                    throw new FormatException("Division by zero is prohibited");
                }
                return intdiv($second, $first);
            default:
                throw new UnknownOperatorType("Unknown type: {$this->type}");
        }
    }
}