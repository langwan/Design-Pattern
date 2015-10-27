<?php

/**
 * 使用代理类可以实现本地功能的远程实现，也可以实现多种代理实现，在不同场景中切换。
 * 例如当客户需要本地部署的时候采用本地代理，当客户需要远程部署的时候采用远程代理。
 */

/**
 * 代理抽象
 */
interface IProxy {
    public function query($sql);
}

/**
 * 远程代理
 */
class DbHttpProxy implements IProxy {
    public function query($sql) {
        return "from remote http\n";
    }
}

/**
 * 本地代理
 */
class DbLocalProxy implements  IProxy {
    public function query($sql) {
        return "from local db\n";
    }
}

/**
 * 真实DB类
 */
class Db implements IProxy {
    private $proxy;
    public function __construct($proxy) {
        $this->proxy = $proxy;
    }

    public function query($sql) {
        return $this->proxy->query($sql);
    }
}

function main() {

    $db = new Db(new DbHttpProxy());
    $item = $db->query("SELECT 1");
    echo $item;

    $db = new Db(new DbLocalProxy());
    $item = $db->query("SELECT 1");
    echo $item;

} main();