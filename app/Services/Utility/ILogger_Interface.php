<?php


namespace App\Services\Utility;


interface ILogger_Interface
{
    function getLogger();
    public function debug($d);
    public function info($i);
    public function warning($w);
    public function error($e);


}
