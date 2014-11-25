<?php

namespace BitWeb\MailModule;

use Zend\Mvc\MvcEvent;

class Module
{
    public function onBootstrap(MvcEvent $event)
    {
        /* @var $mailService \BitWeb\Mail\Service\MailService */
        $mailService = $event->getApplication()->getServiceManager()->get('BitWeb\Mail\Service\MailService');
        $mailService->initializeListener();
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../../config/module.config.php';
    }
}
