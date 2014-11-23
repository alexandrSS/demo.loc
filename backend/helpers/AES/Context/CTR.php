<?php

namespace backend\helpers\AES\Context;

use backend\helpers\AES\Cipher;

class CTR
{
    public $RK;
    public $RKi;
    public $keyLen;

    public $nonce;
    public $buffer = '';

    function __construct($key, $nonce)
    {
        list($this->RK, $this->RKi, $this->keyLen) = Cipher::generateKey($key);
        $this->nonce = array_values(unpack('N4', $nonce));
    }
}