<?php

namespace Bernard\EventListener;

use Symfony\Component\EventDispatcher\GenericEvent;

class ErrorLogSubscriber implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    public function onReject(GenericEvent $event)
    {
        $exception = $event['exception'];

        error_log(sprintf('[bernard] caught exception %s::%s while processing %s.', 
           get_class($exception), $exception->getMessage(), $event->getSubject()->getName()));
    }

    public static function getSubscribedEvents()
    {
        return array(
            'bernard.reject' => array('onReject'),
        );
    }
}
