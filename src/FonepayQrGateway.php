<?php

namespace Omnipay\Fonepay;

use Omnipay\Common\AbstractGateway;

class FonepayQrGateway extends AbstractGateway
{
    public function getName()
    {
        return 'Fonepay QR';
    }

    public function getDefaultParameters()
    {
        return [
            'username' => '',
            'password' => '',
            'testMode' => false,
        ];
    }

    public function getUsername()
    {
        return $this->getParameter('username');
    }

    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }
}
