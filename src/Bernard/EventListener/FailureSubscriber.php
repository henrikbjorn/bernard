<?php

namespace Bernard\EventListener;

use Bernard\QueueFactory;
use Symfony\Component\EventDispatcher\GenericEvent;

class FailureSubscriber implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    protected $queues;
    protected $name;

    public function __construct(QueueFactory $queues, $name = 'failed')
    {
        $this->queues = $queues;
        $this->name = $name;
    }

    public function onReject(GenericEvent $event)
    {
        $envelope = $event->getSubject();

        $event['queue']->acknowledge($envelope);

        $this->queues->create($this->name)->enqueue($envelope);
    }

    public static function getSubscribedEvents()
    {
        return array(
            'bernard.reject' => array('onReject'),
        );
    }
}
