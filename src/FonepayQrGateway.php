<?php

namespace Omnipay\Fonepay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Fonepay\Message\QrPurchaseRequest;
use Omnipay\Fonepay\Message\VerifyQrPaymentRequest;

class FonepayQrGateway extends AbstractGateway
{
    use HasCredentialsTrait;
    use HasSignatureTrait;

    public function getName()
    {
        return 'Fonepay QR';
    }

    public function getDefaultParameters()
    {
        return [
            'merchantCode' => '',
            'username' => '',
            'password' => '',
            'testMode' => false,
        ];
    }

    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    public function purchase(array $parameters = []): QrPurchaseRequest
    {
        return $this->createRequest('\Omnipay\Fonepay\Message\QrPurchaseRequest', $parameters);
    }

    public function completePurchase(array $parameters = []): VerifyQrPaymentRequest
    {
        return $this->createRequest('\Omnipay\Fonepay\Message\VerifyQrPaymentRequest', $parameters);
    }
}
