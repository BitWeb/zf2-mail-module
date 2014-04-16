<?php

namespace BitWeb\MailModule\Service\Factory;

use BitWeb\Mail\Configuration;
use BitWeb\Mail\Service\MailService;
use Zend\Mail\Transport\Sendmail;
use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MailServiceFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        if (!isset($config['mail']) || !isset($config['mail']['smtpOptions'])) {
            $transport = new Sendmail();
        } else {
            $transport = new Smtp(new SmtpOptions($config['mail']['smtpOptions']));
        }

        if (isset($config['mail']) && isset($config['mail']['smtpOptions'])) {
            unset($config['mail']['smtpOptions']);
        }

        $configuration = new Configuration($config['mail']);

        return new MailService($transport, $configuration);
    }
}
