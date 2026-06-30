<?php

namespace App\Services;

use App\Models\User;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorAuthenticator
{
    public function __construct(private readonly Google2FA $google2fa)
    {
    }

    public function generateSecret(): string
    {
        return $this->google2fa->generateSecretKey();
    }

    public function verify(string $secret, string $code): bool
    {
        return (bool) $this->google2fa->verifyKey($secret, $code, 1);
    }

    public function qrCodeSvg(User $user): string
    {
        $renderer = new ImageRenderer(
            new RendererStyle(220),
            new SvgImageBackEnd()
        );

        return (new Writer($renderer))->writeString($this->otpauthUrl($user));
    }

    private function otpauthUrl(User $user): string
    {
        return $this->google2fa->getQRCodeUrl(
            config('app.name', 'Laravel'),
            $user->email,
            $user->two_factor_secret
        );
    }
}
