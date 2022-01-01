<?php


namespace zafarjonovich\PHPSafeException\StringGenerator;

use zafarjonovich\PHPSafeException\base\StringGenerator;

class TextStringGenerator extends StringGenerator
{
    /**
     * @return string
     */
    public function toString()
    {
        return implode("\n\n",$this->levels);
    }

    /**
     * @param \Exception $exception
     */
    protected function toPart($exception)
    {
        return strtr(
            "Message: message\nFile: file\nLine: line\nCode: code",
            [
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'code' => $exception->getCode()
            ]
        );
    }
}