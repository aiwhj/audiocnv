<?php
namespace Aiwhj\audioCNV;

use Aiwhj\audioCNV\Exceptions\NotConvert;
use Aiwhj\audioCNV\Exceptions\NotFound;
use Aiwhj\audioCNV\Exceptions\NotInput;
use Symfony\Component\Process\Process;

class audioCNV
{
    protected static $inFile;
    protected static $inFormat;

    protected static $outFile;
    protected static $outFormat;

    protected static $getFormatCMD = 'ffprobe -v quiet -print_format json -show_format';

    public function setFile(string $inFile = '', string $outFile = '', string $outFormat = '')
    {
        if (!file_exists($inFile)) {
            throw new NotFound("could not find file {$inFile}");
        }
        if (!$outFile) {
            throw new NotInput("could not input file {$outFile}");
        }
        if (file_exists($outFile)) {
            unlink($outFile);
        }
        if (!$outFormat) {
            if (!$outFormat = self::getFormatFromName($outFile)) {
                throw new NotInput("could not input format");
            }
        }

        self::$inFile    = $inFile;
        self::$inFormat  = self::getFormat(self::$inFile)->format_name;
        self::$outFile   = $outFile;
        self::$outFormat = $outFormat;
    }

    public function getFormatFromName($path): string
    {
        return substr(strrchr($path, '.'), 1);
    }

    public function getFormat($path): \stdClass
    {
        if (!file_exists($path)) {
            throw new NotFound("could not find file {$path}");
        }
        $process = new Process(self::$getFormatCMD . " " . escapeshellarg($path));
        $process->run();

        if (!$process->isSuccessful()) {
            throw new NotConvert($process);
        }
        return json_decode(trim($process->getOutput(), " \t\n\r\0\x0B\x0C"))->format;
    }

    public static function output(string $inFile = '', string $outFile = '', string $outFormat = ''): bool
    {
        self::setFile($inFile, $outFile, $outFormat);
        $class = 'Aiwhj\audioCNV\Engine\\' . self::$inFormat . 'To' . self::$outFormat;

        if (!class_exists($class)) {
            throw new NotFound("could not find Engine {$class}");
        }

        $engine = new $class();
        if ($engine->output(self::$inFile, self::$outFile)) {
            return ture;
        }
    }
}
