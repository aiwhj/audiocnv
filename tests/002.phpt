--TEST--
audiocnv_test1() Basic test
--SKIPIF--
<?php
if (!extension_loaded('audiocnv')) {
	echo 'skip';
}
?>
--FILE--
<?php 
$ret = audiocnv_test1();

var_dump($ret);
?>
--EXPECT--
The extension audiocnv is loaded and working!
NULL
