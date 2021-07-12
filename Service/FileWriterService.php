<?php


namespace ProjectService;


use Contract\EntityCollectionSerializableInterface;
use ProjectException\CannotWriteToFileException;
use ProjectException\FileNotFoundException;
use ProjectException\FileNotWritableException;
use ProjectException\FileOpeningException;

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
            $array = $this->collectionSerializer->serialize($collection);
            echo 'Writing entities to the file: ' . basename($fileName) . PHP_EOL;
            $counter = 1;
            foreach ($array as $data) {
                if (!fwrite($file, $data . PHP_EOL)) {
                    throw new CannotWriteToFileException($fileName);
                }
                echo 'Writing entity ' . $counter . PHP_EOL;
                ++$counter;
            }
            echo 'File population completed successfully, written ' . ($counter - 1) . ' entities' . PHP_EOL;
        } catch (CannotWriteToFileException $exception) {
            echo 'Error while writing to file:' . $exception->getMessage() . PHP_EOL;
            $this->fileAccessWrapperService->closeFile($file);
        } catch (FileNotWritableException | FileNotFoundException | FileOpeningException | \Exception $exception) {
            echo $exception->getMessage();
        }
        $this->fileAccessWrapperService->closeFile($file);
    }
}