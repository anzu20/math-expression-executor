<?php
namespace MathExpressionExecutor\Models\Tokens;

/**
 * Class ParenthesisToken
 * Represents parenthesis symbols that can be '(' or ')'
 * @package MathExpressionExecutor\Models\Tokens
 */
class ParenthesisToken extends Token
{
    const SYMBOLS = [self::OPEN_BRACKET, self::CLOSE_BRACKET];
    const OPEN_BRACKET = '(';
    const CLOSE_BRACKET = ')';
}