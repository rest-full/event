<?php

namespace Restfull\Event;

use Restfull\Container\Instances;

/**
 *
 */
trait EventDispatcherTrait
{

    /**
     * @var EventManager
     */
    protected $eventManager;

    /**
     * @param string $name
     * @param array $data
     * @param object|null $object
     *
     * @return EventManager
     */
    public function dispatchEvent(string $name, array $data = [], object $object = null): EventManager
    {
        $instance = new Instances();
        if (!isset($object)) {
            $object = $this;
        }
        $this->eventManager = $instance->resolveClass(
            $instance->assemblyClassOrPath(
                "%s" . DS_REVERSE . 'Event' . DS_REVERSE . 'EventManager',
                [ROOT_NAMESPACE]
            ),
            ['name' => $name, 'subject' => $object, 'data' => $data]
        );
        return $this->eventManager->listeners($name, $this->eventManager);
    }
}
