<?php
/**
 * Redis server tester
 * @package lib-redis
 * @version 0.0.1
 */

namespace LibRedis\Server;

class PHP
{
    static function redis(){
        $result = [
            'success' => false,
            'info' => 'Not installed'
        ];

        $exists = class_exists('Redis');
        if(!$exists)
            return $result;
        
        return [
            'success' => true,
            'info' => '-'
        ];
    }
}