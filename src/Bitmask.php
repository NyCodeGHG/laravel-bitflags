<?php

namespace AwStudio\Bitmask;

class Bitmask
{
    public function get($mask, $bit)
    {
        return (($bit & $mask) == $mask);
    }

    public function add($bit, $mask)
    {
        return $bit | $mask;
    }
    
    public function remove($bit, $mask)
    {
        return $bit & ~$mask;
    }

    public function where($query, $status)
    {
        return $query->where('status', '&', $status);
    }
    
    public function whereNot($query, $status)
    {
        return $query->whereRAW('NOT status & ' . $status);
    }
}
