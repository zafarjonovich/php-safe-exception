<?php


namespace zafarjonovich\PHPSafeException\converter;

use zafarjonovich\PHPSafeException\base\Converter;
use zafarjonovich\PHPSafeException\base\Convertible;

class ArrayConverter extends Converter implements Convertible
{
    public function convert()
    {
        return $this->exception;
    }
}