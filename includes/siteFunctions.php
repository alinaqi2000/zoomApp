<?php
function subString($string, $inc = '...')
{
    $newString = substr($string, 0, 50) . $inc;
    return $newString;
}
function sum($a, $b)
{
    return $a + $b;
}
