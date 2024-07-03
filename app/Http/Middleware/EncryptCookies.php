<?php

namespace App\Http\Middleware;

//use Illuminate\Contracts\Encryption\Encrypter as EncrypterContract;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array<int, string>
     */
    protected $except = [
        'VI_T1PAPSID',
        'VI_T2PAPSID',
        'VI_T3PAPSID',
        'VI_T4PAPSID'
    ];
}
