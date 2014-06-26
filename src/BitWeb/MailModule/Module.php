<?php

namespace BitWeb\MailModule;

use BitWeb\Mail\Service\MailService;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $event)
    {
        /* @var $mailService \BitWeb\Mail\Service\MailService */
        $mailService = $event->getApplication()->getServiceManager()->get(MailService::class);
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../../config/module.config.php';
    }
}
