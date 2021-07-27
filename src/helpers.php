<?php
if (! function_exists('bitmaskAdd')) {
    function bitmaskAdd(array|int $bitmask, int $bit)
    {
        $bitmask = getBitmask($bitmask);

        return $bit | $bitmask;
    }
}

if (! function_exists('bitmaskRemove')) {
    function bitmaskRemove(array|int $bitmask, int $bit)
    {
        $bitmask = getBitmask($bitmask);
        
        return $bitmask & ~$bit;
    }
}

if (! function_exists('getBitmask')) {
    function getBitmask(array|int $value)
    {
        if (is_int($value)) {
            return $value;
        }
        $bitmask = 0;
        foreach ($value as $bit) {
            if (!isPowerOfTwo($bit)) {
                throw new InvalidArgumentException($bit . ' is not a power of two.');
            }
            $bitmask = $bitmask | $bit;
        }

        return $bitmask;
    }
}

if (! function_exists('bitmaskIncludes')) {
    function inBitmask(int $flag, array|int $bitmask)
    {
        $bitmask = getBitmask($bitmask);
        
        return ($flag & $bitmask) == $flag;
    }
}

if (! function_exists('isPowerOfTwo')) {
    function isPowerOfTwo(Int $number)
    {
        return ($number & ($number - 1)) == 0;
    }
}
