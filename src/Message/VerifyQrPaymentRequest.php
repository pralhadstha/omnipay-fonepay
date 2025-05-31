<?php

namespace Omnipay\Fonepay\Message;

class VerifyQrPaymentRequest extends BaseAbstractRequest
{
    public $verifyEndpoint = 'merchant/merchantDetailsForThirdParty/thirdPartyDynamicQrGetStatus';

    public function getData(): array
    {
        $this->validate('productNumber');

        return $this->getMandatoryData();
    }

    public function getMandatoryData(): array
    {
        return array_filter([
            'prn' => $this->getProductNumber(),
            'merchantCode' => $this->getMerchantCode(),
            'dataValidation' => $this->getCheckStatusSignature(),
            'username' => $this->getUsername(),
            'password' => $this->getPassword(),
        ]);
    }

    public function sendData($data)
    {
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $response = $this->httpClient->request('POST', $this->getEndpoint(), $headers, json_encode($data));

        return $this->response = new VerifyQrPaymentResponse($this, $this->handleResponse($response));
    }

    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        $endPoint = $this->getEndpointBase();

        return "{$endPoint}{$this->verifyEndpoint}";
    }
}
