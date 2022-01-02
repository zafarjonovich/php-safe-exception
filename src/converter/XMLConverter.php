<?php


namespace zafarjonovich\PHPSafeException\converter;


use SimpleXMLElement;
use zafarjonovich\PHPSafeException\base\Converter;
use zafarjonovich\PHPSafeException\base\Convertible;

class XMLConverter extends Converter implements Convertible
{
    private $rootTag = 'Exception';
    
    public function setRootTag(string $rootTag)
    {
        $this->rootTag = $rootTag;
    }

    /**
     * @return bool|string
     */
    public function convert()
    {
        $rootTag = $this->rootTag;
        $xml = new SimpleXMLElement("<$rootTag/>");
        $this->toXML($xml, $this->exception);

        $textXml = $xml->asXML();

        return $textXml;
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
    
    public function __toString()
    {
        return $this->convert();
    }
}