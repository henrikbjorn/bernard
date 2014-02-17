<?php

namespace Bernard\EventListener;

use Symfony\Component\EventDispatcher\GenericEvent;
use Psr\Log\LoggerInterface;

class LoggerSubscriber implements \Symfony\Component\EventDispatcher\EventSubscriberInterface
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onProduce(GenericEvent $event)
    {
        $this->logger->info('[bernard] produced {envelope} onto {queue}.', array(
            'envelope' => $event->getSubject(),
            'queue' => $event['queue'],
        ));
    }

    public function onInvoke(GenericEvent $event)
    {
        $this->logger->info('[bernard] invoking receiver for {envelope}.', array(
            'envelope' => $event->getSubject(),
        ));
    }

    public function onReject(GenericEvent $event)
    {
        $this->logger->error('[bernard] caught exception {exception} while processing {envelope}.', array(
            'envelope' => $event->getSubject(),
            'exception' => $event['exception'],
        ));
    }

    public static function getSubscribedEvents()
    {
        return array(
            'bernard.produce' => array('onProduce'),
            'bernard.invoke' => array('onInvoke'),
            'bernard.reject' => array('onReject'),
        );
    }
}
