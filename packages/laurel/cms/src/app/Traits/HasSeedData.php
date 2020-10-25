<?php


namespace Laurel\CMS\Traits;


use League\Flysystem\FileNotFoundException;
use PhpParser\JsonDecoder;

trait HasSeedData
{
    public function getSeedData(string $fileName) : array
    {
        return $this->loadSeedFile(
            $this->createDataPath($fileName)
        );
    }

    protected function createDataPath(string $fileName) : string
    {
        return self::MODULE_DIRECTORY . "/Database/Data/{$fileName}.json";
    }

    protected function loadSeedFile(string $filePath) : array
    {
        throw_if(!file_exists($filePath), FileNotFoundException::class, ...[$filePath]);
        $data = file_get_contents($filePath);
        return (new JsonDecoder)->decode($data);
    }
}
