<?php

namespace Omnipay\Fonepay;

use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class QrBuilder
{
    /**
     * Generates the QR code from the string provided.
     * Used baconqr to allow be used by all the php applications.
     */
    public function render(string $value, int $size = 400): string
    {
        header('Content-Type: image/svg+xml');
        $renderer = new ImageRenderer(
            new RendererStyle($size),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);

        return $writer->writeString($value);
    }

    /**
     * Static function to create the QR code using the render function.
     */
    public static function buildPaymentQr(string $message): string
    {
        $builder = new self();

        return $builder->render($message);
    }
}
