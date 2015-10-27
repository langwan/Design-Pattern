<?php

/**
 * 单例(Singleton)
 * 2015-10-25 langwanluo@gmail.com
 *
 * 当需要不同线程、不同对象之间共享某些资源的时候，资源本身可以使用单例来创建。
 * 当处于多线程当中的时候，要注意创建的方法，确保创建的对象是唯一的。
 */

/**
 * 资源池
 */
class Pool {

    private static $instance = null;

    public static function getInstance() {
        if(Pool::$instance == null) {
            Pool::$instance = new Pool();
        }
        return Pool::$instance;
    }

    public function run() {
        print("this is pool\n");
    }
}

function main() {

    Pool::getInstance()->run();

}main();