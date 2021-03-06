<?php


use fize\io\Directory;
use PHPUnit\Framework\TestCase;

class TestDirectory extends TestCase
{

    public function test__construct()
    {
        $dir = new Directory("../temp");
        $dir->open();

        echo "---1---<br/>\r\n";
        $dir->read(function ($file) {
            echo "{$file}<br/>\r\n";
        });

        $dir->rewind();

        echo "---2---<br/>\r\n";
        $dir->read(function ($file) {
            echo "{$file}<br/>\r\n";
        });

        $dir->close();

        self::assertTrue(true);
    }

    public function test__destruct()
    {
        $dir = new Directory("../temp");
        $dir->open();

        echo "---1---<br/>\r\n";
        $dir->read(function ($file) {
            echo "{$file}<br/>\r\n";
        });

        $dir->rewind();

        echo "---2---<br/>\r\n";
        $dir->read(function ($file) {
            echo "{$file}<br/>\r\n";
        });

        $dir->close();

        self::assertTrue(true);
    }

    public function testDir()
    {
        Directory::chdir("../temp/data");

        $dir = Directory::dir('.');

        self::assertIsObject($dir);

        echo "---1---<br/>\r\n";

        while ($file = $dir->read()) {
            echo "{$file}<br/>\r\n";
        }

        echo "---2---<br/>\r\n";
        while ($file = $dir->read()) {
            echo "{$file}<br/>\r\n";
        }

        echo "---3---<br/>\r\n";
        $dir->rewind();
        while ($file = $dir->read()) {
            echo "{$file}<br/>\r\n";
        }

        $dir->close();
    }

    public function testMkdir()
    {
        $root = dirname(__FILE__);
        var_dump($root);

        $wd = Directory::getcwd();
        var_dump($wd);

        $dir1 = new Directory("../temp/temp2");
        var_dump($dir1);

        $wd = Directory::getcwd();
        var_dump($wd);

        $dir2 = new Directory("../temp/temp1/dir5/测试目录6", true);
        var_dump($dir2);

        $wd = Directory::getcwd();
        var_dump($wd);

        Directory::chdir("../temp/temp1/dir5/测试目录6");  //改变当前工作目录到[测试目录6]
        $result = Directory::mkdir('./测试目录7/测试目录8');  // 相对路径
        self::assertTrue($result);

        $wd = Directory::getcwd();
        var_dump($wd);

        $result = Directory::mkdir(dirname($root) . '/temp/temp1/测试目录1/测试目录2');  // 绝对路径
        self::assertTrue($result);

        $wd = Directory::getcwd();
        var_dump($wd);

        $wd = Directory::getcwd();
        var_dump($wd);
    }

    public function testOpen()
    {
        $dir = new Directory("../temp/temp1");
        $dir->open();

        echo "---1---<br/>\r\n";
        $dir->read(function ($file) {
            echo "{$file}<br/>\r\n";
        });

        $dir->rewind();

        echo "---2---<br/>\r\n";
        $dir->read(function ($file) {
            echo "{$file}<br/>\r\n";
        });

        $dir->close();

        self::assertTrue(true);
    }

    public function testClose()
    {
        $dir = new Directory("../temp/temp1");
        $dir->open();

        echo "---1---<br/>\r\n";
        $dir->read(function ($file) {
            echo "{$file}<br/>\r\n";
        });

        $dir->rewind();

        echo "---2---<br/>\r\n";
        $dir->read(function ($file) {
            echo "{$file}<br/>\r\n";
        });

        $dir->close();
        self::assertTrue(true);
    }

    public function testChdir()
    {
        define('PATH_ROOT', dirname(dirname(__FILE__)) . '/temp');

        $dir = new Directory(PATH_ROOT . "/temp1");
        $dir->close();
        $path1 = Directory::getcwd();

        $result = Directory::chdir(PATH_ROOT . '/temp1/测试目录1');
        self::assertTrue($result);

        $path2 = Directory::getcwd();
        self::assertNotEquals($path1, $path2);
    }

    /**
     * @todo 测试未通过
     */
    public function testChroot()
    {
        define('PATH_ROOT', dirname(dirname(__FILE__)). '/temp');

        $result = Directory::chroot(PATH_ROOT . '/temp1/测试目录1');
        var_dump($result);
        self::assertTrue($result);
    }

    public function testGetcwd()
    {
        $root = dirname(dirname(__FILE__)). '/temp';
        var_dump($root);

        $wd0 = Directory::getcwd();
        var_dump($wd0);

        $dir1 = new Directory("../temp/temp1/dir1/dir2/测试目录3");
        var_dump($dir1);

        $wd1 = Directory::getcwd();
        var_dump($wd1);

        self::assertEquals($wd0, $wd1);

        $dir2 = new Directory("../temp/temp1/dir5/测试目录6", true);
        var_dump($dir2);
        Directory::chdir("../temp/temp1/dir5/测试目录6");
        $wd2 = Directory::getcwd();
        var_dump($wd2);

        self::assertNotEquals($wd1, $wd2);

        Directory::mkdir('./测试目录7/测试目录8');

        $wd3 = Directory::getcwd();
        var_dump($wd3);
        self::assertEquals($wd2, $wd3);

        Directory::mkdir($root . '/temp1/测试目录1/测试目录2');  //绝对路径

        $wd4 = Directory::getcwd();
        var_dump($wd4);
        self::assertEquals($wd3, $wd4);

        $wd5 = Directory::getcwd();
        var_dump($wd5);
        self::assertEquals($wd4, $wd5);
    }

    public function testRead()
    {
        $dir = new Directory("../temp/temp1");
        $dir->open();

        echo "---1---<br/>\r\n";
        $dir->read(function ($file) {
            echo "{$file}<br/>\r\n";
        });

        $dir->rewind();

        echo "---2---<br/>\r\n";
        $dir->read(function ($file) {
            echo "{$file}<br/>\r\n";
        });

        $dir->close();

        self::assertTrue(true);
    }

    public function testRewind()
    {
        $dir = new Directory("../temp/temp1");
        $dir->open();

        echo "---1---<br/>\r\n";
        $dir->read(function ($file) {
            echo "{$file}<br/>\r\n";
        });

        $dir->rewind();

        echo "---2---<br/>\r\n";
        $dir->read(function ($file) {
            echo "{$file}<br/>\r\n";
        });

        $dir->close();
        self::assertTrue(true);
    }

    public function testClear()
    {
        $dir = new Directory("../temp/temp1/测试目录1");
        $result = $dir->clear();
        var_dump($result);
        self::assertTrue($result);
    }

    public function testScan()
    {
        $result = Directory::chdir('../temp/temp1/测试目录1');
        var_dump($result);
        $list = Directory::scan('.');
        var_dump($list);
        self::assertIsArray($list);
    }

    public function testTouch()
    {
        define('PATH_ROOT', dirname(dirname(__FILE__)) . '/temp');

        $result = Directory::chdir(PATH_ROOT . '/temp1/测试目录1');
        var_dump($result);

        $result = Directory::createFile('test22');
        var_dump($result);
        self::assertTrue($result);

        $result = Directory::createFile('test22.txt');
        var_dump($result);
        self::assertTrue($result);

        $result = Directory::createFile('测试文件22.txt');
        var_dump($result);
        self::assertTrue($result);

        $result = Directory::createFile('./新建文件夹/测试文件22.txt', true);
        var_dump($result);
        self::assertTrue($result);
    }

    public function testCreateFile()
    {
        define('PATH_ROOT', dirname(dirname(__FILE__)) . '/temp');

        $result = Directory::chdir(PATH_ROOT . '/temp1/测试目录1');
        var_dump($result);

        $result = Directory::createFile('test22');
        var_dump($result);
        self::assertTrue($result);

        $result = Directory::createFile('test22.txt');
        var_dump($result);
        self::assertTrue($result);

        $result = Directory::createFile('测试文件22.txt');
        var_dump($result);
        self::assertTrue($result);

        $result = Directory::createFile('./新建文件夹/测试文件22.txt', true);
        var_dump($result);
        self::assertTrue($result);
    }

    public function testCreateDirectory()
    {
        define('PATH_ROOT', dirname(dirname(__FILE__)) . '/temp');

        $result = Directory::chdir(PATH_ROOT . '/temp1/测试目录1');
        var_dump($result);

        $result = Directory::createDirectory('新建文件夹2');
        self::assertTrue($result);

        $result = Directory::createDirectory('./新建文件夹3/新建文件夹33/新建文件夹333', 0777, true);
        self::assertTrue($result);
    }

    public function testUnlink()
    {
        define('PATH_ROOT', dirname(dirname(__FILE__)) . '/temp');

        $result = Directory::chdir(PATH_ROOT . '/temp1/测试目录1');
        var_dump($result);

        $result = Directory::deleteFile('test22');
        self::assertTrue($result);

        $result = Directory::deleteFile('./新建文件夹/测试文件22.txt');
        self::assertTrue($result);
    }

    public function testDeleteFile()
    {
        define('PATH_ROOT', dirname(dirname(__FILE__)) . '/temp');

        $result = Directory::chdir(PATH_ROOT . '/temp1/测试目录1');
        var_dump($result);

        $result = Directory::deleteFile('test22');
        self::assertTrue($result);

        $result = Directory::deleteFile('./新建文件夹/测试文件22.txt');
        self::assertTrue($result);
    }

    public function testRmdir()
    {
        define('PATH_ROOT', dirname(dirname(__FILE__)) . '/temp');

        $result = Directory::chdir(PATH_ROOT . '/temp');
        self::assertTrue($result);

        $result = Directory::rmdir('./temp1/dir5/测试目录6/测试目录7/测试目录8');
        self::assertTrue($result);
    }

    public function testDeleteDirectory()
    {
        define('PATH_ROOT', dirname(dirname(__FILE__)) . '/temp');

        $result = Directory::chdir(PATH_ROOT . '/temp');
        self::assertTrue($result);

        $result = Directory::deleteDirectory('test1');
        self::assertTrue($result);

        $result = Directory::deleteDirectory('test3', true);
        self::assertTrue($result);

        $result = Directory::deleteDirectory('./temp1/dir5', true);
        self::assertTrue($result);
    }

    public function testClearDirectory()
    {
        define('PATH_ROOT', dirname(dirname(__FILE__)) . '/temp');
        $result = Directory::clearDirectory(PATH_ROOT . '/temp1');
        var_dump($result);
        self::assertTrue($result);
    }

    public function testIsDir()
    {

        define('PATH_ROOT', dirname(dirname(__FILE__)) . '/temp');

        Directory::chdir(PATH_ROOT . "/temp");

        $result = Directory::isDir('temp1');
        self::assertTrue($result);

        $result = Directory::isDir('Temp1');
        self::assertFalse($result);

        $result = Directory::isDir('temp2');
        self::assertFalse($result);

        $result = Directory::isDir('./temp1/测试目录1');
        self::assertFalse($result);
    }

    public function testGlob()
    {
        define('PATH_ROOT', dirname(dirname(__FILE__)) . '/temp');
        Directory::chdir(PATH_ROOT);

        $result = Directory::glob('*.txt');
        var_dump($result);
        self::assertIsArray($result);
    }

    public function testDiskFreeSpace()
    {
        define('PATH_ROOT', dirname(dirname(__FILE__)) . '/temp');
        $space = Directory::diskFreeSpace(PATH_ROOT);
        var_dump($space);
        self::assertIsFloat($space);
    }

    public function testDiskTotalSpace()
    {
        define('PATH_ROOT', dirname(dirname(__FILE__)) . '/temp');
        $space = Directory::diskTotalSpace(PATH_ROOT);
        var_dump($space);
        self::assertIsFloat($space);
    }

    public function testRealpath()
    {
        $dir = new Directory("../temp/temp1");
        $realpath = $dir->realpath();
        var_dump($realpath);
        self::assertIsString($realpath);
    }

    public function testTempnam()
    {
        define('PATH_ROOT', dirname(dirname(__FILE__)) . '/temp');
        Directory::chdir(PATH_ROOT);

        $file_full_name = Directory::tempnam('test');
        var_dump($file_full_name);
        self::assertIsString($file_full_name);
    }
}
