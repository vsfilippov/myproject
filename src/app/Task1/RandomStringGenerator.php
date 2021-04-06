<?php

namespace App\Task1;

class RandomStringGenerator
{
    /**
     * @param int $length
     * @param string|array $allowedSymbols
     * @return string
     */
    public function generate(int $length, $allowedSymbols): string
    {
        if ($length < 0) {
            throw new \Exception('The length can\'t be a negative number!');
        }

        if (!is_array($allowedSymbols) || !is_string($allowedSymbols)) {
            throw new \Exception('You can pass either array or string as a second parameter');
        }

        $preparedSymbols = is_array($allowedSymbols) ? $allowedSymbols : str_split($allowedSymbols);
        $result = [];
        for ($i = 1; $length >= $i; $i++) {
            array_push($result, $allowedSymbols[array_rand($preparedSymbols, 1)]);
        }

        return implode($result);
    }
}
