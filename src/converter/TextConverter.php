<?php


namespace zafarjonovich\PHPSafeException\converter;

use zafarjonovich\PHPSafeException\base\Converter;
use zafarjonovich\PHPSafeException\base\Convertible;

class TextConverter extends Converter implements Convertible
{
    /**
     * @return string
     */
    public function convert()
    {
        $parts = [];

        $parts[] = strtr(
            "Message: message\nFile: file\nLine: line\nCode: code",
            $this->exception
        );

        foreach ($this->exception['traces'] as $trace) {
            $parts[] = urldecode(http_build_query($trace,'',"\n"));
        }

        return implode("\n\n",$parts);
    }
    
    public function __toString()
    {
        return $this->convert();
    }
}