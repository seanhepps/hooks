<?php
/** .-------------------------------------------------------------------
 * |    Author: Sean <982653014@qq.com>
 * |  Created at: 2020/5/29
 * | Copyright (c) 2015-2030. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace seanhepps\hooks\Facades;


use Illuminate\Support\Facades\Facade;

class Hook extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'hook';
    }
}
