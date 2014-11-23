<?php

namespace backend\helpers\AES\Padding;

interface Scheme
{
    function getPadding($message);
    function getPadLen($message);
} 
