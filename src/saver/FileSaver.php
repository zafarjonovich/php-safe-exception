<?php


namespace zafarjonovich\PHPSafeException\saver;


use zafarjonovich\PHPSafeException\base\Saver;

class FileSaver implements Saver
{
    /**
     * @var string $filePath
     */
    protected $filePath;

    public function __construct(string $filePath)
    {
        $dir = dirname($filePath).DIRECTORY_SEPARATOR;

        if (!is_dir($dir))
            throw new \Exception($dir . ' directory not exists');

        $this->filePath = $filePath;
    }

    public function save($exceptionText)
    {
        file_put_contents(
            $this->filePath,
            (string)$exceptionText
        );
    }
}