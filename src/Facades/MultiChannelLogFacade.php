<?php

namespace CodeBridge\CBLogger\Facades;

use Illuminate\Support\Facades\Facade;

class MultiChannelLogFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cb_multichannellog';
    }
}
