<?php

namespace App\Helpers;

use Random\RandomException;

class CustomEncrypter
{
    /**
     * The encryption key.
     *
     * @var string
     */
    protected string $key;

    /**
     * The algorithm used for encryption.
     *
     * @var string
     */
    protected string $cipher;

    protected string $iv;

    public function __construct(string $key = 'VisionIas', string $cipher = 'AES-256-CBC', string  $iv = '61c3a8b52f8574b3')
    {
        $this->key = $this->generateAESKey($key);
        $this->cipher = $cipher;
        $this->iv = $iv;
    }

    /**
     * Encrypt the given value.
     *
     * @param mixed $value
     * @return string
     */
    public function encrypt(mixed $value): string
    {
        $encrypted = openssl_encrypt($value, $this->cipher, $this->key, OPENSSL_RAW_DATA, $this->iv);
        return base64_encode($encrypted);
    }

    /**
     * Decrypt the given payload.
     *
     * @param string $payload
     */
    public function decrypt(string $payload): mixed
    {
        $decrypted = openssl_decrypt(
            base64_decode($payload),
            $this->cipher,
            $this->key,
            OPENSSL_RAW_DATA,
            $this->iv
        );

        return $decrypted;
    }

    /**
     * Get the encryption key.
     *
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    private function generateAESKey($key): string
    {
        $keyLength = 128; // AES-256 requires a 32-byte key
        return substr(hash('sha256', $key, true), 0, $keyLength);
    }
}

