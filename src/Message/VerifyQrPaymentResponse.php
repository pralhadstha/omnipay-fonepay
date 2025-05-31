<?php

namespace Omnipay\Fonepay\Message;

use Omnipay\Common\Message\RequestInterface;

class VerifyQrPaymentResponse extends BaseAbstractResponse
{
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
        $this->request = $request;
        $this->data = $data;
    }

    public function isSuccessful(): bool
    {
        return $this->checkStatus('success');
    }

    public function isPending(): bool
    {
        return $this->checkStatus('pending');
    }

    public function isFailed(): bool
    {
        return $this->checkStatus('failed');
    }

    /**
     * @return string
     */
    public function getResponseText()
    {
        return (string) trim($this->data->paymentStatus);
    }

    /**
     * Extracts status from the response.
     *
     * @param mixed $type
     *
     * @return bool
     */
    public function checkStatus($type)
    {
        $string = strtolower($this->getResponseText());

        return in_array($string, [$type]);
    }
}
