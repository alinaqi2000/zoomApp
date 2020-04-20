<?php
function subString($string, $inc = '...')
{
    $newString = substr($string, 0, 6) . $inc;
    return $newString;
}
