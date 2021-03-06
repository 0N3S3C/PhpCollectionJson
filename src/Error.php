<?php

namespace PhpCollectionJson;

class Error implements \JsonSerializable
{
    private $title;
    private $code;
    private $message;

    /**
     * Error constructor.
     * @param string $message
     * @param string $code
     * @param string $title
     */
    public function __construct($message = '', $code = '', $title = '')
    {
        $this->title = $title;
        $this->code = $code;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    public function jsonSerialize()
    {
        $object = new \stdClass();

        if (strlen(trim($this->title)) > 0) {
            $object->title = $this->title;
        }

        if (strlen(trim($this->message)) > 0) {
            $object->message = $this->message;
        }

        if (strlen(trim($this->code)) > 0) {
            $object->code = $this->code;
        }

        return $object;
    }

    public function __toString()
    {
        return json_encode($this);
    }

    /**
     * @param array $array
     * @return Error
     */
    public static function fromArray(array $array)
    {
        $message = '';
        $code = '';
        $title = '';

        if (array_key_exists('message', $array)) {
            $message = $array['message'];
        }

        if (array_key_exists('code', $array)) {
            $code = $array['code'];
        }

        if (array_key_exists('title', $array)) {
            $title = $array['title'];
        }

        return new self($message, $code, $title);
    }
}
