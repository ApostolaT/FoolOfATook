<?php


namespace FoolOfATook\Service;


use FoolOfATook\Exception\RandomNumberBoundariesException;


class RandomNumberGenerator
{
    // We want to have numbers with a precision of three decimal values
    private const MULT = 1000;
    public function generateRandomInt(int $min, int $max): int
    {
        $result = mt_rand($min, $max);

        if (!$result) {
            throw new RandomNumberBoundariesException(
                'Min is bigger than Max in random integer generator'. PHP_EOL
            );
        }

        return $result;
    }

    public function generateRandomFloat(float $min, float $max): float
    {

        if ($min > $max) {
            throw new RandomNumberBoundariesException(
                'Min is bigger than Max in random float generator'. PHP_EOL
            );
        }

        return (float)mt_rand($min * $this::MULT, $max * $this::MULT) / (float)$this::MULT;
    }
}