<?php
/**
 * 助手函数文件
 */

if (!function_exists('json_manage')){
    /**
     * 创建一个json对象容器
     * @param int $depth
     * @return \DeathSatan\Json\Json
     */
    function json_manage( int $depth=512): \DeathSatan\Json\Json
    {
        \DeathSatan\Json\Json::setDepth($depth);
        return new \DeathSatan\Json\Json;
    }
}