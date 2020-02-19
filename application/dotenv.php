<?php


class Dotenv
{
    public function load($path, $file = '.env')
    {

        $filename = $path . '/' . $file;

        try {
            $lines = $this->fileToArray($filename);

            foreach ($lines as $line) {
                list($name, $value) = $this->filter($line);
                putenv("$name=$value");
            }
        } catch (Exception $exception) {
            echo $exception;
        }
    }

    private function filter($item)
    {
        list($name, $value) = array_map('trim', explode('=', $item, 2));

        return [$name, $value];
    }

    private function fileToArray($file)
    {
        $lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        return $lines;
    }
}