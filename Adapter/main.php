<?php

/**
 * 常用在视图与数据之间的关系上，视图依据事先约定好的方法获取数据，适配器决定从何处获取数据。
 * 可以是从数据库，也可以是简单的内存数组里。
 */

/**
 * 适配器的抽象
 */
interface IAdapter {
    public function getItem($index);
    public function count();
}

/**
 * 最简单的数据适配器
 */
class SimpleAdapter implements IAdapter {

    private $items = array('langwan', 'tom', 'carl');

    public function getItem($index) {
        return $this->items[$index];
    }

    public function count() {
        return count($this->items);
    }

}

/**
 * 视图的抽象
 */
interface IView {
    public function setAdapter($adapter);
}

/**
 * 具体的视图类
 */
class ListView implements IView {

    private $adapter;

    public function setAdapter($adapter) {
        $this->adapter = $adapter;
    }

    public function show() {
        $count = $this->adapter->count();
        for($i = 0; $i < $count; $i++) {
            $item = $this->adapter->getItem($i);
            echo sprintf("item(%d) = %s\n", $i, $item);
        }
    }
}

function main() {
    $view = new ListView();
    $view->setAdapter(new SimpleAdapter());
    $view->show();
}main();