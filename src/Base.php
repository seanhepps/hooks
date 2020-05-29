<?php
/** .-------------------------------------------------------------------
 * |    Author: Sean <982653014@qq.com>
 * |  Created at: 2020/5/28
 * | Copyright (c) 2015-2030. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace seanhepps\hooks;


abstract class Base extends Storage
{
    protected $listeners = null;

    /**
     * Base constructor
     * 初始化
     */
    public function __construct()
    {
        $this->listeners = [];
        // 如果需要修改保存位置，可以更改这个路径
        $this->savePath = storage_path('hook');
        // 装载钩子缓存
        $filename = $this->getCacheFileName();
        $path = $this->savePath . DIRECTORY_SEPARATOR . $filename;
        
        if (is_file($path)) {
            $this->listeners = include $path;
        }
    }

    /**
     * 注册一个钩子
     * @param string $hook 钩子名称
     * @param string $class 类
     * @param int $priority 优先级
     */
    public function register(string $hook, string $class, $priority = 20)
    {
        if (!isset($this->listeners[$hook])) {
            $this->listeners[$hook] = [];
        }
        
        list($class, $method, $isStatic) = $this->resolveClass($class);
        
        $this->listeners[$hook][] = [
            'class' =>  $class,
            'method'    =>  $method,
            'is_static' =>  $isStatic,
            'priority'  =>  $priority
        ];
        return $this;
    }

    /**
     * 移除钩子
     * @param $hook
     * @param $class
     * @param $method
     * @param $priority
     * @return $this
     */
    public function remove($hook, $class, $priority = 20)
    {
        if (!isset($this->listeners[$hook])) {
            return $this;
        }
        list($class, $method, $isStatic) = $this->resolveClass($class);
        
        foreach ($this->listeners[$hook] as $k => $v) {
            if ($v['class'] == $class 
                && $v['method'] == $method 
                && $v['priority'] == $priority) {
                unset($this->listeners[$hook][$k]);
            }
        }
        return $this;
    }

    /**
     * 分析类调用方式
     * @param $class
     * @return array
     */
    protected function resolveClass($class)
    {
        // 分析调用方法
        $isStatic = strpos($class, '::') ? true : false;
        if ($isStatic) {
            list($class, $method) = explode('::', $class);
        } else {
            $class .= '@handle';
            list($class, $method) = explode('@', $class);
        }
        return [$class, $method, $isStatic];
    }

    /**
     * 通过钩子名称移除
     * @param $hook
     * @return $this
     */
    public function removeAll($hook = null)
    {
        if ($hook) {
            unset($this->listeners[$hook]);
        } else {
            $this->listeners = [];
        }
        return $this;
    }

    /**
     * 获取监听器
     * @param $hook
     * @return array|mixed
     */
    public function getListeners($hook)
    {
        if (isset($this->listeners[$hook])) {
            // 按照优先级排序
            $hooks = $this->listeners[$hook];
            usort($hooks, function($a, $b) {
                return $a['priority'] <=> $b['priority'];
            });
            return $hooks;
        }
        return [];
    }

    /**
     * 缓存到文件
     */
    public function save()
    {
        
        $filename = $this->getCacheFileName();
        return $this->storage($filename, $this->listeners);
    }
    
    protected function getCacheFileName()
    {
        $name = explode('\\', get_called_class());
        return strtolower(array_pop($name) . '.php');
    }

    protected function invoke($class, $method, $isStatic, $parameters)
    {
        $call = null;
        // 静态调用
        if ($isStatic) {
            $call = $class . '::' . $method;
        } else {
            $call = [app($class), $method];
        }
        return call_user_func_array($call, [$parameters]);
    }
    
    abstract public function fire($hook, $arvs);
}
