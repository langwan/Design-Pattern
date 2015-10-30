<?php

/**
 * 观察者模式是一个常用的插件通知机制，当一个程序被执行，可能会触发一个消息管理机制。
 * 这个消息管理机制会通知所有被注册的插件进行更新（工作）。
 * 例如你的程序负责发布最新的内容，插件A负责渲染出手机H5的页面，插件B负责渲染出PC
 * 需要的html页面。
 */

/**
 * 被观察者的抽象
 */
interface IObserver {
    public function getId();
    public function update();
}

/**
 * 主题的抽象
 */
interface INotify {
    public function add($observer);
    public function remove($observer);
    public function notify();
}

/**
 * 插件 A
 */
class PluginA implements IObserver {

    public function getId() {
        return "plugin_a";
    }

    public function update() {
        echo "Plugin A is updated.\n";
    }
}

/**
 * 插件 B
 */
class PluginB implements IObserver {

    public function getId() {
        return "plugin_b";
    }

    public function update() {
        echo "Plugin B is updated.\n";
    }
}

/**
 * 消息管理器
 */
class ActionNotify implements INotify {
    private $observers = array();
    public function add($observer) {
        $this->observers[$observer->getId()] = $observer;
    }
    public function remove($observer) {
        unset($this->observers[$observer->getId()]);
    }
    public function notify() {
        foreach($this->observers as $observer) {
            $observer->update();
        }
    }
}

/**
 * 模拟一个被执行的程序，当条件为true的时候通知所有插件更新
 */
class Action {

    private $notify;

    public function __construct() {
        $this->notify = new ActionNotify();
        $this->notify->add(new PluginA());
        $this->notify->add(new PluginB());
    }

    public function run($notify = false) {
        if($notify == true) {
            $this->notify->notify();
        }
    }
}

function main() {

    $action = new Action();
    echo "action run(false)\n";
    $action->run(false);
    echo "action run(true)\n";
    $action->run(true);

} main();