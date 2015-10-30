<?php

/**
 * 装饰者因为在java io中大量使用而出名，我们根据序列化的需要，对文件的内容进行读取和写入的处理。
 * Java采用了装饰者模式来嵌套出不同的处理类。每一个新的装饰者都在父类的基础上继续加工内容并返回
 * 给用户。
 */

/**
 * 模拟一个文件，任何设备读取的时候返回一个数组
 */
class File {

    public function read() {
        return array('name' => 'langwan');
    }

}

/**
 * 流的抽象
 */
interface IStream {
    public function read();
}

/**
 * 简单的流，返回File中的原始内容
 */
class SimpleStream implements  IStream {

    private $file = null;

    public function __construct($file) {
        $this->file = $file;
    }

    public function read() {
        return $this->file->read();
    }
}

/**
 * Json流返回一个json格式的数据
 */
class JsonString extends SimpleStream {
    private $file = null;

    public function __construct($file) {
        $this->file = $file;
    }

    public function read() {
        $content = $this->file->read();
        return json_encode($content);
    }
}

function main() {

    $file = new File();

    $stringStream = new SimpleStream($file);

    echo sprintf("%s\n", print_r($stringStream->read(), true));

    $stringStream = new JsonString($file);

    echo sprintf("%s\n", $stringStream->read());

}main();