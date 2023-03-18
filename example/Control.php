<?php

namespace Example;

use Restfull\Event\EventDispatcherTrait;
use Restfull\Http\Response;

class Control
{
    use EventDispatcherTrait;

    public function eventProccessValidation(string $event, array $data = [])
    {
        $event = $this->dispatchEvent('Controller.' . $event, $data);
        $result = $event->getResult();
        if ($result instanceof Response) {
            return null;
        }
        return $result;
    }
}