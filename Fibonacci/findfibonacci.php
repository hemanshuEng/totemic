<?php
/**
 * Find Fibonacci Number
 * Created by PhpStorm.
 * User: Hemanshu Khodiyar
 * Date: 30/09/2020
 */

declare(strict_types=1);

/**
 *
 * @param int $number
 * @return int
 */
function fibonacci(int $number)
{
    if ($number <=  1) {
        return $number;
    }
    return fibonacci($number - 1) + fibonacci($number - 2);
}

echo fibonacci(6);
