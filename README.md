# audiocnv
ffmpeg 音频格式转换 for php 
```
<?php
require '../vendor/autoload.php';
use Aiwhj\audioCNV\audioCNV;
audioCNV::output('test.mp3', 'test.wav');
```