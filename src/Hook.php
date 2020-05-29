<?php
/** .-------------------------------------------------------------------
 * |    Author: Sean <982653014@qq.com>
 * |  Created at: 2020/5/28
 * | Copyright (c) 2015-2030. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace seanhepps\hooks;


class Hook
{
    protected $action = null;
    protected $filter = null;
    
    public function __construct()
    {
        $this->action = new Action();
        $this->filter = new Filter();
    }

    /**
     * 返回操作钩子实例
     * @return Action|null
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * 返回过滤器实例
     * @return Filter|null
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * 执行操作
     * @param $hook
     * @param $args
     * @return bool
     */
    public function action($hook, $args)
    {
        return $this->action->fire($hook, $args);
    }

    /**
     * 执行过滤器
     * @param $hook
     * @param $args
     * @return bool|mixed
     */
    public function filter($hook, $args)
    {
        return $this->filter->fire($hook, $args);
    }
}
