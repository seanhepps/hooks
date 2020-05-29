<?php
/** .-------------------------------------------------------------------
 * |    Author: Sean <982653014@qq.com>
 * |  Created at: 2020/5/29
 * | Copyright (c) 2015-2030. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace seanhepps\hooks\tests;


class TestClass
{
    public static $num = 1;
    public function run($args)
    {
        self::$num++;
        return $args . self::$num;
    }
}
