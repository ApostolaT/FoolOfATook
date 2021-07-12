<?php


namespace ProjectService;


use Contract\EntityCollectionSerializableInterface;
use ProjectException\FileNotFoundException;
use ProjectException\FileNotReadableException;
use ProjectException\FileOpeningException;
use ProjectException\UnexpectedReadFailException;

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
            $file = $this->fileAccessWrapperService->openToReadFromFile($fileName);
            echo 'Starting deserialization of the Children of Iluvatar' . PHP_EOL;
            $counter = 1;
            while (($buffer = fgets($file)) !== false) {
                echo "Deserializing object #$counter" . PHP_EOL;
                $childrenOnIluvatar = $this->collectionSerializer->unserializeOne($buffer, $childrenOnIluvatar);
                ++$counter;
            }
            if (!feof($file)) {
                echo "---Exception---" . PHP_EOL;
                throw new UnexpectedReadFailException("Unexpected read fail in $file" . PHP_EOL);
            }
            echo "Deserialization of " . ($counter - 1) . " objects ended successfully" . PHP_EOL;
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