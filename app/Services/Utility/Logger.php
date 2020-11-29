<?php


namespace App\Services\Utility;


use Illuminate\Support\Facades\Log;

class Logger implements ILogger_Interface
{

    function getLogger()
    {
        // TODO: Implement getLogger() method.
    }

    public function debug($message)
    {
        Log::debug($message);
    }

    public function info($info)
    {
        Log::info($info);
    }

    public function warning($warning)
    {
        Log::warning($warning);
    }

    public function error($e)
    {
        Log::error($e);
    }
}
