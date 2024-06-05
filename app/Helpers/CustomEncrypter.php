<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;
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
        $this->cipher = $cipher;
        $this->iv = $iv;
        $this->setEncryptionKey($key);
    }

    /**
     * Encrypt the given value.
     *
     * @param mixed $value
     * @return string
     */
    public function encryptData(mixed $value): string
    {
        $encrypted = openssl_encrypt($value, $this->cipher, $this->key, OPENSSL_RAW_DATA, $this->iv);
        return base64_encode($encrypted);
    }

    /**
     * Decrypt the given payload.
     *
     * @param string $payload
     * @return string|false
     */
    public function decryptData(string $payload): string|false
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
     * Set the encryption key.
     *
     * @param string $key
     * @return void
     */
    public function setEncryptionKey(string $key): void
    {
        $this->key = $this->generateAESKey($key);
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
        $keyLength = 128;
        return substr(hash('sha256', $key, true), 0, $keyLength);
    }

    /**
     * Static method to set the encryption key.
     *
     * @param string $key
     * @return void
     */
    public static function setKey(string $key): void
    {
        $instance = App::make(CustomEncrypter::class);
        $instance->setEncryptionKey($key);
    }

    public static function resetKey(): void
    {
        $instance = App::make(CustomEncrypter::class);
        $instance->setEncryptionKey(config('app.encryption_key_v2'));
    }

    /**
     * Static method to encrypt a value.
     *
     * @param mixed $value
     * @return string
     */
    public static function encrypt(mixed $value): string
    {
        $instance = App::make(CustomEncrypter::class);
        return $instance->encryptData($value);
    }

    /**
     * Static method to decrypt a payload.
     *
     * @param string $payload
     * @return string|false
     */
    public static function decrypt(string $payload): string|false
    {
        $instance = App::make(CustomEncrypter::class);
        return $instance->decryptData($payload);
    }
}

