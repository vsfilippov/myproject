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
        // str_split($allowedSymbols) если строка а если массив то исправить
        $result = [];
        for ($i = 1; $length >= $i; $i++) {
            array_push($result, $allowedSymbols[array_rand(str_split($allowedSymbols), 1)]);
        }

        return implode($result);
    }
}