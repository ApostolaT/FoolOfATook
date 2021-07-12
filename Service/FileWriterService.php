<?php


namespace ProjectService;


use Contract\EntityCollectionSerializableInterface;
use ProjectException\CannotWriteToFileException;
use ProjectException\FileClosingException;
use ProjectException\FileNotFoundException;
use ProjectException\FileNotWritableException;
use ProjectException\FileOpeningException;

class FileWriterService
{
    private EntityCollectionSerializableInterface $collectionSerializer;

    public function __construct(EntityCollectionSerializableInterface $collectionSerializer)
    {
        $this->collectionSerializer =  $collectionSerializer;
    }

    public function writeToFile(string $fileName, \Traversable $collection): void
    {
        try {
            echo 'Opening file: ' . basename($fileName) . PHP_EOL;
            $file = $this->openFile($fileName);
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
            $this->closeFile($file);
        } catch (FileNotWritableException | FileNotFoundException | FileOpeningException | \Exception $exception) {
            echo $exception->getMessage();
        }
        $this->closeFile($file);
    }

    /**
     * @throws FileNotWritableException
     * @throws FileNotFoundException
     * @throws FileOpeningException
     */
    private function openFile(string $fileName)
    {
        echo "Checking if " . basename($fileName) . " is writable..." . PHP_EOL;
        if (!is_writable($fileName)) {
            echo '---Exception occurred---' . PHP_EOL;
            throw new FileNotWritableException('---File ' . $fileName . ' is not writable!'. PHP_EOL);
        }
        echo "Writable OK!" . PHP_EOL;
        echo "Checking if " . basename($fileName) . " exists..." . PHP_EOL;
        if (!file_exists($fileName)) {
            echo '---Exception occurred---' . PHP_EOL;
            throw new FileNotFoundException('---File ' . $fileName . ' not found!' . PHP_EOL);
        }
        echo "File found!" . PHP_EOL;
        echo "Trying to open " . basename($fileName) . " for writing" . PHP_EOL;
        $file = fopen($fileName, "w");
        if (!$file) {
            echo '---Exception occurred---' . PHP_EOL;
            throw new FileOpeningException('---File' . $fileName . ' could not be open!' . PHP_EOL);
        }
        echo "File opened successfully!" . PHP_EOL;
        return $file;
    }

    /**
     * @throws FileClosingException
     */
    private function closeFile($file)
    {
        echo 'Trying to close working file...' . PHP_EOL;
        if (!fclose($file)) {
            echo '---Exception occurred---' . PHP_EOL;
            throw new FileClosingException('---File could not be closed!' . PHP_EOL);
        }
        echo 'Success upon closing the file!' . PHP_EOL;
    }
}