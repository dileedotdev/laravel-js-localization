<?php

namespace Dinhdjj\JsLocalization\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Dinhdjj\JsLocalization\JsLocalization
 */
class JsLocalization extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'js-localization';
    }
}
