<?php

namespace Corals\Modules\Quality\Facades;

use Illuminate\Support\Facades\Facade;

class Quality extends Facade
{
    /**
     * @return mixed
     */
    protected static function getFacadeAccessor()
    {
        return \Corals\Modules\Quality\Classes\Quality::class;
    }
}