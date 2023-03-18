<?php

namespace Restfull\Event;

/**
 *
 */
class Event
{

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var object
     */
    protected $subject;

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var mixed
     */
    private $result;


    /**
     * @param string $name
     * @param object $subject
     * @param array $data
     */
    public function __construct(string $name, object $subject, array $data = [])
    {
        $this->name = $name;
        $this->subject = $subject;
        if (count($data) > 0) {
            $this->data = $data;
        }
        return $this;
    }

    /**
     * @param string $result
     *
     * @return $this|mixed
     */
    public function result($result = '')
    {
        if (!empty($result)) {
            $this->result = $result;
            return $this;
        }
        return $this->result;
    }
}
