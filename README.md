# Omnipay: Fonepay QR

**Fonepay QR driver for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP.

This package implements Fonepay QR support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/).

To install, simply require `league/omnipay` and `pralhadstha/omnipay-fonepay` with Composer:

```
composer require league/omnipay pralhadstha/omnipay-fonepay
```

## Basic Usage

### Purchase

```php
    use Omnipay\Omnipay;
    use Exception;

    $gateway = Omnipay::create('Fonepay_FonepayQr');

    $gateway->setUsername('fonepay_username_or_email');
    $gateway->setPassword('fonepay_password');
    $gateway->setMerchantCode('merchant_code_provided_by_fonepay');
    $gateway->setTestMode(false);

    try {
        $response = $gateway->purchase([
            'amount' => 1000.00,
            'productNumber' => "PN-100",
            'remarks1' => "Remark 1",
            'remarks2' => "Remark 2 if needed",
        ])->send();

        if ($response->isCustomRedirect()) {
            // provide the page to display the QR code.
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
```

### Payment Complete

```php
    $gateway = Omnipay::create('Fonepay_FonepayQr');

    $gateway->setUsername('fonepay_username_or_email');
    $gateway->setPassword('fonepay_password');
    $gateway->setMerchantCode('merchant_code_provided_by_fonepay');
    $gateway->setTestMode(false);

    try {
        $response = $gateway->completePurchase([
            'productNumber' => "PN-100",
        ])->send();

        if ($response->isSuccessful()) {
            // Payment is successful and will have fonepayTraceId.
        } else {
            // Payment is received as failed and need to again check if payment is completed.
        }
    } catch (Exception $e) {
        return $e->getMessage();
    }
```

## Working Example

Want to see working examples before integrating them into your project? View the examples **[here](https://github.com/pralhadstha/payment-gateways-examples)**

## Official Doc

Please follow the Official Document provided by Fonepay to understand about the parameters and their descriptions. The document is not publicly available. Please contact Fonepay team for the documents.

## Contributing

Contributions are **welcome** and will be fully **credited**.

Contributions can be made via a Pull Request on [Github](https://github.com/pralhadstha/omnipay-fonepay).

## Support

If you are having general issues with Omnipay Khalti, drop an email to pralhad.shrestha05@gmail.com for quick support.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/pralhadstha/omnipay-fonepay/issues),
or better yet, fork the library and submit a pull request.

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
