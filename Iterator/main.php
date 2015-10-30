<?php

/**
 * 迭代器在不同语言中都有实现，我使用了PHP自己的特性，我只需要实现一个具体的ItemList，
 * 实现Iterator的五个方法，就可以被正常的像普通数组一样被遍历出来
 */
class ItemList implements Iterator {

    private $position = 0;
    private $items = array();

    public function puts($items) {
        $this->items = $items;
    }

    public function __construct() {
        $this->position = 0;
    }

    public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return $this->items[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return isset($this->items[$this->position]);
    }
}

function main() {

    $list = new ItemList();
    $list->puts(array(1, 2, 3, 4, 5, 6));

    foreach($list as $key => $val) {
        echo "$val\n";
    }

} main();