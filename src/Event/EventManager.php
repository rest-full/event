<?php

namespace Restfull\Event;

use Restfull\Container\Instances;

/**
 *
 */
class EventManager extends Event
{

    /**
     * @param string $classEvent
     * @param object $obj
     *
     * @return $this
     */
    public function listeners(string $classEvent, object $obj): EventManager
    {
        if ($this->name != $classEvent) {
            $this->name = $classEvent;
        }
        list($control, $method) = explode(".", $this->name);
        $this->alignData($obj);
        foreach ($this->implementedEvents($control) as $event) {
            if ($method == $event) {
                $result = (new Instances())->callebleFunctionActive(
                    [$this->subject, $method],
                    array_values($this->data)
                );
            }
        }
        if (isset($result)) {
            $this->result($result);
        }
        return $this;
    }

    /**
     * @param object $obj
     *
     * @return EventManager
     */
    private function alignData(object $obj): EventManager
    {
        $this->data = count($this->data) > 0 ? array_merge([$obj], $this->data)
            : [$obj];
        return $this;
    }

    /**
     * @param string $key
     *
     * @return string[]
     */
    public function implementedEvents(string $key): array
    {
        $listening = [
            'Controller' => [
                'beforeFilter',
                'beforeRedirect',
                'afterFilter'
            ],
            'ORM' => [
                'beforeValidator',
                'afterValidator',
                'beforeFind',
                'afterFind'
            ],
            'View' => [
                'beforeRenderFile',
                'afterRenderFile',
                'beforeRender',
                'afterRender',
                'beforeLayout',
                'afterLayout'
            ]
        ];
        return $listening[$key];
    }
}
