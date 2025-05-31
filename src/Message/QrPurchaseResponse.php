<?php

namespace Omnipay\Fonepay\Message;

use Omnipay\Common\Message\RequestInterface;

class QrPurchaseResponse extends BaseAbstractResponse
{
    public function __construct(RequestInterface $request, $data)
    {
        parent::__construct($request, $data);
        $this->request = $request;
        $this->data = $data;
    }

    public function getQrData(): string
    {
        return $this->data->qrMessage;
    }

    public function getClientCode(): string
    {
        return $this->data->clientCode;
    }

    public function getStatus(): string
    {
        return $this->data->status;
    }

    public function getSuccess(): string
    {
        return $this->data->success;
    }

    public function getRequestedDate(): string
    {
        return $this->data->requested_date;
    }

    public function getMerchantCode(): string
    {
        return $this->data->merchantCode;
    }

    public function getMerchantWebSocketUrl(): string
    {
        return $this->data->merchantWebSocketUrl;
    }

    public function getThirdpartyQrWebSocketUrl(): string
    {
        return $this->data->thirdpartyQrWebSocketUrl;
    }
}
