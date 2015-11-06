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

        if (!$this->hasSmtpOptions($config)) {
            $transport = new Sendmail();
        } else {
            $transport = new Smtp(new SmtpOptions($config['mail']['smtpOptions']));
        }

        if (array_key_exists('mail', $config) && array_key_exists('smtpOptions', $config['mail'])) {
            unset($config['mail']['smtpOptions']);
        }

        $configuration = new Configuration($config['mail']);

        return new MailService($transport, $configuration);
    }

    protected function hasSmtpOptions(array $config)
    {
        if (!array_key_exists('mail', $config)) {
            return false;
        }

        if (!array_key_exists('smtpOptions', $config['mail'])) {
            return false;
        }

        if ($config['mail']['smtpOptions'] === null) {
            return false;
        }

        return true;
    }
}
