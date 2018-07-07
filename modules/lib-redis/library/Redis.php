<?php
/**
 * Redis handler
 * @package lib-redis
 * @version 0.0.1
 */

namespace LibRedis\Library;

class Redis
{
    private static $conn = [];

    static function getConn(string $name): ?object{
        if(isset(self::$conn[$name]))
            return self::$conn[$name];

        $opts = \Mim::$app->config->libRedis;
        if(!isset($opts->$name)){
            trigger_error('Redis connection named `' . $name . '` not found');
            return null;
        }

        $opt = $opts->$name;

        // redis object
        $conn = new \Redis;
        if(isset($opt->socket) && $opt->socket)
            $conn->connect($opt->socket);
        else{
            $args = [$opt->host];
            if($opt->port)
                $args[] = $opt->port;
            call_user_func_array([$conn, 'connect'], $args);
        }

        // auth
        if($opt->password)
            $conn->auth($opt->password);

        // select database
        $conn->select($opt->db);

        // key prefix
        if($opt->prefix)
            $conn->setOption(\Redis::OPT_PREFIX, $opt->prefix);

        // serializer
        $conn->setOption(\Redis::OPT_SERIALIZER, \Redis::SERIALIZER_PHP);

        self::$conn[$name] = $conn;

        return self::$conn[$name];
    }

    static function __callStatic(string $name, array $args=[]){
        $conn = array_shift($args);
        if(!$conn)
            return trigger_error('No connection name provided');

        $rconn = self::getConn($conn);
        if(!$rconn)
            return;

        return call_user_func_array([$rconn, $name], $args);
    }
}