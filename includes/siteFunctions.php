<?php
function subString($string, $len = 50, $inc = '...')
{
    if (strlen($string) > $len) {
        $newString = substr($string, 0, $len) . $inc;
        return $newString;
    }
    return $string;
}
function sum($a, $b)
{
    return $a + $b;
}
