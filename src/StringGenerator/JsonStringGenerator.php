<?php


namespace zafarjonovich\PHPSafeException\StringGenerator;

use zafarjonovich\PHPSafeException\base\StringGenerator;

class JsonStringGenerator extends StringGenerator
{
    public function toString()
    {
        return json_encode($this->levels);
    }

    /**
     * @param \Exception $exception
     */
    protected function toPart($exception)
    {
        return [
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'code' => $exception->getCode()
        ];
    }
}