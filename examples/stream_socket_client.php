<?php
require_once "../vendor/autoload.php";

use fize\io\Stream;
use fize\io\File;

$fp = Stream::socketClient("tcp://www.baidu.com:80", $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    $ffp = new File($fp);
    $ffp->write("GET / HTTP/1.0\r\nHost: www.baidu.com\r\nAccept: */*\r\n\r\n");
    while (!$ffp->eof()) {
        echo $ffp->gets(1024);
    }
    $ffp->close();
}