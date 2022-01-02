<?php


namespace zafarjonovich\PHPSafeException\converter;

use zafarjonovich\PHPSafeException\base\Converter;
use zafarjonovich\PHPSafeException\base\Convertible;

class JsonConverter extends Converter implements Convertible
{
    protected $pretty;

    public function pretty()
    {
        $this->pretty = true;
        return $this;
    }

    public function convert()
    {
        $flags = 0;

        if ($this->pretty)
            $flags = JSON_PRETTY_PRINT;

        return json_encode($this->exception,$flags);
    }
    
    public function __toString()
    {
        return $this->convert();
    }
}