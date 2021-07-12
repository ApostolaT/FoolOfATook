<?php


namespace FoolOfATook\Service;


use FoolOfATook\Contract\EntityCollectionSerializableInterface;
use FoolOfATook\Exception\CannotWriteToFileException;
use FoolOfATook\Exception\FileNotFoundException;
use FoolOfATook\Exception\FileNotWritableException;
use FoolOfATook\Exception\FileOpeningException;


class FileWriterService
{
    private EntityCollectionSerializableInterface   $collectionSerializer;
    private FileAccessWrapperService                $fileAccessWrapperService;

    public function __construct(
        EntityCollectionSerializableInterface $collectionSerializer,
        FileAccessWrapperService $fileAccessWrapperService
    ){
        $this->collectionSerializer         = $collectionSerializer;
        $this->fileAccessWrapperService     = $fileAccessWrapperService;
    }

    public function writeToFile(string $fileName, \Traversable $collection): void
    {
        try {
            echo 'Opening file: ' . basename($fileName) . PHP_EOL;
            $file = $this->fileAccessWrapperService->openToWriteInFile($fileName);
            echo 'Starting serialization of the Children of Iluvatar' . PHP_EOL;
            $data = $this->collectionSerializer->serialize($collection);
            echo 'Writing entities to the file: ' . basename($fileName) . PHP_EOL;
            if (!fwrite($file, $data . PHP_EOL)) {
                throw new CannotWriteToFileException($fileName);
            }
        } catch (CannotWriteToFileException $exception) {
            echo 'Error while writing to file:' . $exception->getMessage() . PHP_EOL;
            $this->fileAccessWrapperService->closeFile($file);
        } catch (FileNotWritableException | FileNotFoundException | FileOpeningException | \Exception $exception) {
            echo $exception->getMessage();
        }
        $this->fileAccessWrapperService->closeFile($file);
    }
}