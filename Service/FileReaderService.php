<?php


namespace FoolOfATook\Service;


use FoolOfATook\Contract\EntityCollectionSerializableInterface;
use FoolOfATook\Exception\FileNotFoundException;
use FoolOfATook\Exception\FileNotReadableException;
use FoolOfATook\Exception\FileOpeningException;
use FoolOfATook\Exception\UnexpectedReadFailException;

class FileReaderService
{
    private EntityCollectionSerializableInterface   $collectionSerializer;
    private FileAccessWrapperService                $fileAccessWrapperService;

    public function __construct(
        EntityCollectionSerializableInterface   $collectionSerializable,
        FileAccessWrapperService                $fileAccessWrapperService
    ){
        $this->collectionSerializer         = $collectionSerializable;
        $this->fileAccessWrapperService     = $fileAccessWrapperService;
    }

    public function readFromFile(string $fileName, \Traversable $childrenOnIluvatar): \Traversable
    {
        try {
            echo 'Opening file: ' . basename($fileName) . PHP_EOL;
            // TODO: Refactor code due to utilization of the file_get_contents();
            $file = $this->fileAccessWrapperService->openToReadFromFile($fileName);
            echo 'Starting deserialization of the Children of Iluvatar' . PHP_EOL;
            $buffer = file_get_contents($fileName);
            if (false === $buffer) {
                echo "---Exception---" . PHP_EOL;
                throw new UnexpectedReadFailException("Unexpected read fail in " . basename($fileName) . PHP_EOL);
            }
            echo "Deserializing objects..." . PHP_EOL;
            $childrenOnIluvatar = $this->collectionSerializer->unserialize($buffer);
        } catch (UnexpectedReadFailException $exception) {
            echo $exception->getMessage();
            $this->fileAccessWrapperService->closeFile($file);
        } catch (FileNotReadableException | FileNotFoundException | FileOpeningException | \Exception $exception) {
            echo $exception->getMessage();
        }
        $this->fileAccessWrapperService->closeFile($file);

        return $childrenOnIluvatar;
    }
}