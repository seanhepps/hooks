<?php
/** .-------------------------------------------------------------------
 * |    Author: Sean <982653014@qq.com>
 * |  Created at: 2020/5/28
 * | Copyright (c) 2015-2030. All Rights Reserved.
 * '-------------------------------------------------------------------*/

namespace seanhepps\hooks;


class Storage
{
    public $savePath = '';
    
    public function storage($filename, array $data)
    {
        $data = $this->generateData($data);
        $this->existDir($this->savePath);
        
        return file_put_contents($this->savePath . DIRECTORY_SEPARATOR . $filename, $data);
    }
    
    protected function existDir($savePath)
    {
        return is_dir($savePath) || mkdir($savePath, 0754, true);
    }
    
    protected function generateData($data)
    {
        return "<?php\nreturn " . var_export($data, true) . ';';
    }
}
