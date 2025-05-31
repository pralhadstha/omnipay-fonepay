<?php

namespace Omnipay\Fonepay\Message;

class QrPurchaseRequest extends BaseAbstractRequest
{
    public $purchaseEndpoint = 'merchant/merchantDetailsForThirdParty/thirdPartyDynamicQrDownload';

    public function getData(): array
    {
        $this->validate('amount', 'remarks1', 'remarks1', 'remarks2', 'productNumber');

        return array_merge([
            'amount' => $this->getAmount(),
            'remarks1' => $this->getRemarks1(),
            'remarks2' => $this->getRemarks2(),
        ], $this->getMandatoryData());
    }

    public function getMandatoryData(): array
    {
        return array_filter([
            'prn' => $this->getProductNumber(),
            'merchantCode' => $this->getMerchantCode(),
            'dataValidation' => $this->getSignature(),
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

        return $this->response = new QrPurchaseResponse($this, $this->handleResponse($response));
    }

    /**
     * @return string
     */
    protected function getEndpoint(): string
    {
        $endPoint = $this->getEndpointBase();

        return "{$endPoint}{$this->purchaseEndpoint}";
    }
}
