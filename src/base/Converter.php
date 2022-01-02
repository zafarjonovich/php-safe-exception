<?php


namespace zafarjonovich\PHPSafeException\base;


abstract class Converter
{
    protected $exception;

    protected $showTraceArgs = false;

    /**
     * TextGenerator constructor.
     * @param \Exception $exception
     * @param int $levelCount
     */
    public function __construct($exception,int $traceLevel = 1)
    {
        $this->exception = [
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'code' => $exception->getCode(),
            'traces' => $this->getTraceArray($exception,$traceLevel)
        ];
    }

    private function getTraceArray($exception,$traceLevel)
    {
        $traces = array_slice($exception->getTrace(),0,$traceLevel);

        if (!$this->showTraceArgs) {
            foreach ($traces as $index => $trace) {
                if (isset($trace['args']))
                    unset($traces[$index]['args']);
            }
        }

        return $traces;
    }

    public function showTraceArgs()
    {
        $this->showTraceArgs = true;
        return $this;
    }
}