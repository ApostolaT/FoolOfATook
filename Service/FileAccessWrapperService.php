<?php


namespace FoolOfATook\Service;


use FoolOfATook\Exception\FileClosingException;
use FoolOfATook\Exception\FileNotFoundException;
use FoolOfATook\Exception\FileNotReadableException;
use FoolOfATook\Exception\FileNotWritableException;
use FoolOfATook\Exception\FileOpeningException;

class FileAccessWrapperService
{
    /**
     * @throws FileNotWritableException
     * @throws FileNotFoundException
     * @throws FileOpeningException
     * @return resource
     */
    public function openToWriteInFile(string $fileName)
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
     * @throws FileNotFoundException
     * @throws FileOpeningException
     * @throws FileNotReadableException
     * @return resource
     */
    public function openToReadFromFile(string $fileName)
    {
        echo "Checking if " . basename($fileName) . " is readable..." . PHP_EOL;
        if (!is_readable($fileName)) {
            echo '---Exception occurred---' . PHP_EOL;
            throw new FileNotReadableException('---File ' . $fileName . ' is not readable!'. PHP_EOL);
        }
        echo "Readable OK!" . PHP_EOL;
        echo "Checking if " . basename($fileName) . " exists..." . PHP_EOL;
        if (!file_exists($fileName)) {
            echo '---Exception occurred---' . PHP_EOL;
            throw new FileNotFoundException('---File ' . $fileName . ' not found!' . PHP_EOL);
        }
        echo "File found!" . PHP_EOL;
        echo "Trying to open " . basename($fileName) . " for reading" . PHP_EOL;
        $file = fopen($fileName, "r");
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
    public function closeFile($file): void
    {
        echo 'Trying to close working file...' . PHP_EOL;
        if (!fclose($file)) {
            echo '---Exception occurred---' . PHP_EOL;
            throw new FileClosingException('---File could not be closed!' . PHP_EOL);
        }
        echo 'Success upon closing the file!' . PHP_EOL;
    }
}