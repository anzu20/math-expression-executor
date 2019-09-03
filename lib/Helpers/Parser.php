<?php
namespace MathExpressionExecutor\Helpers;

use MathExpressionExecutor\Exceptions\FormatException;
use MathExpressionExecutor\Models\Tokens\OperandToken;
use MathExpressionExecutor\Models\Tokens\OperatorToken;
use MathExpressionExecutor\Models\Tokens\ParenthesisToken;
use MathExpressionExecutor\Exceptions\UnknownOperatorType;

/**
 * Class Parser
 * @package MathExpressionExecutor\Helpers
 */
class Parser
{
    /**
     * Parse expression to tokens
     * @param string $expression
     * @return array
     * @throws FormatException
     * @throws UnknownOperatorType
     */
    public static function tokenize(string $expression)
    {
        $result = [];
        for ($i = 0; $i < strlen($expression); $i++) {
            $result[] = self::getToken($expression[$i]);
        }
        return $result;
    }

    /**
     * Parse one character to token
     * @param string $chr
     * @return OperandToken|OperatorToken|ParenthesisToken
     * @throws FormatException
     * @throws UnknownOperatorType
     */
    public static function getToken(string $chr)
    {
        if (in_array($chr, OperatorToken::SYMBOLS)) {
            $token = new OperatorToken($chr);
        } elseif (ctype_digit($chr)) {
            $token = new OperandToken($chr);
        } elseif (in_array($chr, ParenthesisToken::SYMBOLS)) {
            $token = new ParenthesisToken($chr);
        } else {
            throw new FormatException("Unknown symbol type: '$chr'");
        }
        return $token;
    }
}