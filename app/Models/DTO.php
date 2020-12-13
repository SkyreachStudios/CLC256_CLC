<?php


namespace App\Models;


class DTO implements \JsonSerializable
{
    private $errorCode;
    private $errorMessage;
    private $data;

    /**
     * DTO constructor.
     * @param $errorCode
     * @param $errorMessage
     * @param $data
     */
    public function __construct($errorCode, $errorMessage, $data)
    {
        $this->errorCode = $errorCode;
        $this->errorMessage = $errorMessage;
        $this->data = $data;
    }

    public function jsonSerialize()
    {
        return json_encode($this->data);
    }


    //getters


    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }
}
