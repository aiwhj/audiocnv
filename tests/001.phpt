--TEST--
Check if audiocnv is loaded
--SKIPIF--
<?php
if (!extension_loaded('audiocnv')) {
	echo 'skip';
}
?>
--FILE--
<?php 
echo 'The extension "audiocnv" is available';
?>
--EXPECT--
The extension "audiocnv" is available
