<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;
use Random\RandomException;

class CustomEncrypter
{
    /**
     * The encryption key.
     *
     * @var string|null
     */
    protected string|null $key;

    /**
     * The algorithm used for encryption.
     *
     * @var string
     */
    protected string $cipher;

    protected string $iv;

    public function __construct(string $cipher = 'AES-256-CBC', string  $iv = '61c3a8b52f8574b3')
    {
        $this->cipher = $cipher;
        $this->iv = $iv;
        $this->key = null;
    }

    /**
     * Encrypt the given value.
     *
     * @param mixed $value
     * @param string $key
     * @return string
     */
    public function encryptData(mixed $value, string $key): string
    {
        $encrypted = openssl_encrypt(
            $value,
            $this->cipher,
            $this->key ?? $this->generateAESKey($key),
            OPENSSL_RAW_DATA, $this->iv);
        return base64_encode($encrypted);
    }

    /**
     * Decrypt the given payload.
     *
     * @param string $payload
     * @param string $key
     * @return string|false
     */
    public function decryptData(string $payload, string $key): string|false
    {
        return openssl_decrypt(
            base64_decode($payload),
            $this->cipher,
            $this->key ?? $this->generateAESKey($key),
            OPENSSL_RAW_DATA,
            $this->iv
        );
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
     * @return string|null
     */
    public function getEncryptionKey(): string|null
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

    public static function getKey(): string|null
    {
        $instance = App::make(CustomEncrypter::class);
        dd($instance->getEncryptionKey());
        return $instance->getEncryptionKey();
    }

    public static function resetKey(): void
    {
        $instance = App::make(CustomEncrypter::class);
        $instance->key = null;
    }

    /**
     * Static method to encrypt a value.
     *
     * @param mixed $value
     * @param string $key
     * @return string
     */
    public static function encrypt(mixed $value, string $key = 'VisionIas'): string
    {
        $instance = App::make(CustomEncrypter::class);
        return $instance->encryptData($value, $key);
    }

    /**
     * Static method to decrypt a payload.
     *
     * @param string $payload
     * @param string $key
     * @return string|false
     */
    public static function decrypt(string $payload, string $key = 'VisionIas'): string|false
    {
        $instance = App::make(CustomEncrypter::class);
        return $instance->decryptData($payload, $key);
    }
}

