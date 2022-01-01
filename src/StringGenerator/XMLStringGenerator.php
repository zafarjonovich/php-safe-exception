<?php


namespace zafarjonovich\PHPSafeException\StringGenerator;


use SimpleXMLElement;
use zafarjonovich\PHPSafeException\base\StringGenerator;

class XMLStringGenerator extends StringGenerator
{
    private $rootTag = 'Exception';

    public function setRootTag(string $rootTag)
    {
        $this->rootTag = $rootTag;
    }

    /**
     * @return bool|string
     */
    public function toString()
    {
        $rootTag = $this->rootTag;
        $xml = new SimpleXMLElement("<$rootTag/>");
        $this->toXML($xml, $this->levels);
        return $xml->asXML();
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


    private function toXML(SimpleXMLElement $object, array $data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $new_object = $object->addChild($key);
                $this->toXML($new_object, $value);
            } else {

                if ($key != 0 && $key == (int) $key) {
                    $key = "key_$key";
                }

                $object->addChild($key, $value);
            }
        }
    }
}