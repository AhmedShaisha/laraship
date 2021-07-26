<?php

namespace Corals\Modules\Support\Facades;

use Illuminate\Support\Facades\Facade;

class Support extends Facade
{
    /**
     * @return mixed
     */
    protected static function getFacadeAccessor()
    {
        return \Corals\Modules\Support\Classes\Support::class;
    }
}