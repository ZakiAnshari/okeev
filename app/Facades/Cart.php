<?php

namespace App\Facades;
use illuminate\Support\Facades\Facade;

class Cart Extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'cart';
    }
}