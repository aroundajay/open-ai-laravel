<?php

namespace Orhanerday\OpenAi\Laravel;

use Illuminate\Support\Facades\Facade;

class OpenAiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'OpenAi';
    }
}
