<?php


namespace zafarjonovich\PHPSafeException\components;


use zafarjonovich\PHPSafeException\base\Saver;

class MultipleSaver implements Saver
{
    /**
     * @var Saver[] $savers
     */
    private $savers = [];

    public function addSaver(Saver $saver)
    {
        $this->savers[] = $saver;
    }

    public function save($exceptionText)
    {
        foreach ($this->savers as $saver) {
            $saver->save($exceptionText);
        }
    }
}