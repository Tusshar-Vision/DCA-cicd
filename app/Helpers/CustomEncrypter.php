<?php

namespace App\Helpers;

use Illuminate\Contracts\Encryption\Encrypter;
use Random\RandomException;

class CustomEncrypter implements Encrypter
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

    /**
     * Create a new encrypter instance.
     *
     * @param string $key
     * @param string $cipher
     * @return void
     * @throws \RuntimeException
     */
    public function __construct(string $key, string $cipher = 'aes-256-cbc')
    {
        $key = (string) $key;

        if (!in_array($cipher, openssl_get_cipher_methods())) {
            throw new \RuntimeException("Unsupported cipher: {$cipher}");
        }

        $this->key = $key;
        $this->cipher = $cipher;
    }

    /**
     * Encrypt the given value.
     *
     * @param mixed $value
     * @param bool $serialize
     * @return string
     * @throws RandomException
     */
    public function encrypt($value, $serialize = true): string
    {
        if ($serialize) {
            $value = serialize($value);
        }

        $iv = random_bytes(openssl_cipher_iv_length($this->cipher)); // Generate random IV

        $encrypted = openssl_encrypt($value, $this->cipher, hex2bin($this->key), OPENSSL_RAW_DATA, $iv);

        $payload = [
            'iv' => base64_encode($iv),
            'value' => base64_encode($encrypted),
        ];

        return base64_encode(serialize($payload));
    }

    /**
     * Decrypt the given payload.
     *
     * @param string $payload
     * @param bool $unserialize
     * @return mixed
     * @throws \Exception
     */
    public function decrypt($payload, $unserialize = true): mixed
    {
        $payload = unserialize(base64_decode($payload));

        if (!isset($payload['iv']) || !isset($payload['value'])) {
            throw new \Exception('Invalid payload format');
        }

        $iv = base64_decode($payload['iv']);
        $decrypted = openssl_decrypt(
            base64_decode($payload['value']),
            $this->cipher,
            hex2bin($this->key),
            OPENSSL_RAW_DATA,
            $iv
        );

        if ($unserialize) {
            $decrypted = unserialize($decrypted);
        }

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
}

