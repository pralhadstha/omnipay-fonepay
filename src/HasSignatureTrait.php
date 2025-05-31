<?php

namespace Omnipay\Fonepay;

trait HasSignatureTrait
{
    /**
     * Generates the signature for the message.
     *
     * @param mixed $message
     *
     * @return string
     */
    public function generateSignature($message)
    {
        $signedMessage = hash_hmac('sha512', $message, $this->getPassword());

        return $signedMessage;
    }

    public function setSignature($value)
    {
        return $this->setParameter('signature', $this->generateSignature($value));
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        if ($signature = $this->getParameter('signature')) {
            return $signature;
        }

        $value = implode(",", [
            'amount'     => $this->getAmount(),
            'prn' => $this->getProductNumber(),
            'merchantCode' => $this->getMerchantCode(),
            'remarks1'     => $this->getRemarks1(),
            'remarks2'     => $this->getRemarks2(),
        ]);

        return $this->generateSignature($value);
    }

    /**
     * @return string
     */
    public function getCheckStatusSignature()
    {
        $value = implode(",", [
            'prn' => $this->getProductNumber(),
            'merchantCode' => $this->getMerchantCode(),
        ]);

        return $this->generateSignature($value);
    }
}
