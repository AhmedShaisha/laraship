<?php

namespace Corals\Modules\Approval\Facades;

use Illuminate\Support\Facades\Facade;

class Approval extends Facade
{
    /**
     * @return mixed
     */
    protected static function getFacadeAccessor()
    {
        return \Corals\Modules\Approval\Classes\Approval::class;
    }
}
