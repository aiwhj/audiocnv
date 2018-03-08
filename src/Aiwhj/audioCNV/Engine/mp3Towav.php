<?php
namespace Aiwhj\audioCNV\Engine;

use Aiwhj\audioCNV\Exceptions\NotConvert;
use Aiwhj\audioCNV\Exceptions\NotFound;
use Symfony\Component\Process\Process;

class mp3Towav
{
    protected $CMD = 'ffmpeg -i %s -f wav %s';

    public function output($input, $output): bool
    {
        if (!file_exists($input)) {
            throw new NotFound("could not find file {$input}");
        }
        $process = new Process(sprintf($this->CMD, escapeshellarg($input), escapeshellarg($output)));
        $process->run();

        if (!$process->isSuccessful()) {
            throw new NotConvert($process);
        }
        return true;
    }
}
