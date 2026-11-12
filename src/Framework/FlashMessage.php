<?php
namespace Framework;

class FlashMessage
{
    protected $message;
    protected $type;

    public static $TYPE_SUCCESS = 'success';
    public static $TYPE_ERROR = 'error';
    public static $TYPE_INFO = 'info';


    public function __construct($message, $type = null)
    {
        $this->message = $message;
        $this->type = $type ?? self::$TYPE_INFO;
    }
    
    public function getMessage()
    {
        return $this->message;
    }

    public function getType()
    {
        return $this->type;
    }
}