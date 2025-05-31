<?php

namespace Omnipay\Fonepay\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Fonepay\HasCredentialsTrait;
use Omnipay\Fonepay\HasSignatureTrait;

abstract class BaseAbstractRequest extends AbstractRequest
{
    use HasCredentialsTrait;
    use HasSignatureTrait;

    protected $liveEndpoint = 'https://merchantapi.fonepay.com/api/';
    protected $testEndpoint = 'https://dev-merchantapi.fonepay.com/api/';

    public function getEndpointBase(): string
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }

    public function setReturnUrl($value)
    {
        return $this->setParameter('returnUrl', $value);
    }

    public function getWebsiteUrl()
    {
        return $this->getParameter('websiteUrl');
    }

    public function setWebsiteUrl($value)
    {
        return $this->setParameter('websiteUrl', $value);
    }

    public function getAmount()
    {
        return $this->getParameter('amount');
    }

    public function setAmount($value)
    {
        return $this->setParameter('amount', $value);
    }

    public function getProductNumber()
    {
        return $this->getParameter('productNumber');
    }

    public function setProductNumber($value)
    {
        return $this->setParameter('productNumber', $value);
    }

    public function getRemarks1()
    {
        return $this->getParameter('remarks1');
    }

    public function setRemarks1($value)
    {
        return $this->setParameter('remarks1', $value);
    }

    public function getRemarks2()
    {
        return $this->getParameter('remarks2');
    }

    public function setRemarks2($value)
    {
        return $this->setParameter('remarks2', $value);
    }

    protected function handleResponse($response): object
    {
        $body = json_decode($response->getBody()->getContents());

        if ($response->getStatusCode() == 401) {
            throw new InvalidRequestException($body->detail);
        }

        if ($response->getStatusCode() == 400) {
            throw new InvalidRequestException(json_encode($body));
        }

        if ($response->getStatusCode() == 409) {
            throw new InvalidRequestException(json_encode($body));
        }


        return $body;
    }
}
