<?php


namespace zafarjonovich\PHPSafeException\base;


abstract class StringGenerator
{
    protected $levels = [];

    /**
     * TextGenerator constructor.
     * @param \Exception $exception
     * @param int $levelCount
     */
    public function __construct($exception,int $levelCount = 1)
    {
        while(
            $exception instanceof \Exception &&
            count($this->levels) < $levelCount
        ) {
            $this->levels[] = $this->toPart($exception);
            $exception = $exception->getPrevious();
        }
    }

    abstract public function toString();

    /**
     * TextGenerator constructor.
     * @param \Exception $exception
     */
    abstract protected function toPart($exception);

    public function __toString()
    {
        return $this->toString();
    }
}