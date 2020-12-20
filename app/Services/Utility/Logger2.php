<?php


namespace App\Services\Utility;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\FormattableHandlerInterface;
use Whoops\Exception\Formatter;

class Logger2 implements ILogger_Interface
{


    function getLogger()
    {
        $logger = new \Monolog\Logger('logger');
        $stream = new StreamHandler('..\storage\logs\laravel.log');
        $formatter = new Formatter();
        $logger->pushHandler($stream);
        return $logger;


        // TODO: Implement getLogger() method.
    }

    public function debug($d)
    {
     (new \Monolog\Logger)->DEBUG($d);
        // TODO: Implement debug() method.
    }

    public function info($i)
    {
        $logger=$this->getLogger();
        $logger->INFO($i);
        // TODO: Implement info() method.
    }

    public function warning($w)
    {
        (new \Monolog\Logger)->WARNING($w);
        // TODO: Implement warning() method.
    }

    public function error($e)
    {
        (new \Monolog\Logger)->ERROR($e);
        // TODO: Implement error() method.
    }
}
