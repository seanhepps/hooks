<?php
/** .-------------------------------------------------------------------
 * |    Author: Sean <982653014@qq.com>
 * |  Created at: 2020/5/28
 * | Copyright (c) 2015-2030. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace seanhepps\hooks;


class Filter extends Base
{
    public function fire($hook, $args)
    {
        // 获取钩子
        $hooks = $this->getListeners($hook);
        if (!$hooks) {
            return $args;
        }

        // 执行
        foreach ($hooks as $k => $v) {
            $args = $this->invoke($v['class'], $v['method'], $v['is_static'], $args);
        }
        return $args;
    }
}
