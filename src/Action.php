<?php
/** .-------------------------------------------------------------------
 * |    Author: Sean <982653014@qq.com>
 * |  Created at: 2020/5/28
 * | Copyright (c) 2015-2030. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace seanhepps\hooks;


class Action extends Base
{
    public function fire($hook, $args)
    {
        // 获取钩子
        $hooks = $this->getListeners($hook);
        if (!$hooks) return true;
        
        // 执行
        foreach ($hooks as $k => $v) {
            $result = $this->invoke($v['class'], $v['method'], $v['is_static'], $args);
            // 如果 返回false停止
            if ($result === false) break;
        }
        return true;
    }
}
